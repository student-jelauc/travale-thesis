<?php


namespace App\Http\Controllers;


use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\Facility;
use App\Entities\Accommodations\Room;
use App\Entities\Accommodations\RoomType;
use App\Forms\Helpers\FormBuilderTrait;
use App\Forms\RoomForm;
use App\Forms\RoomsForm;
use App\Helpers\Select2Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    use FormBuilderTrait;

    /**
     * RoomsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function overview(Request $request)
    {
        $this->authorize('viewAny', Room::class);

        $query = Room::selectQuery()
            ->with('accommodation')
            ->orderBy('accommodation_id')
            ->orderBy(\DB::raw("NULLIF(regexp_replace(floor, '\D', '', 'g'), '')::int"))
            ->orderBy('room_type_id');

        foreach (['accommodation_id', 'room_type_id', 'floor'] as $filter) {
            if (!$request->{$filter}) {
                continue;
            }

            $query->whereIn($filter, Arr::wrap($request->{$filter}));
        }

        if ($request->facility_id) {
            $query->whereHas('facilities', function ($query) use ($request) {
                $query->whereIn('entity_id', Arr::wrap($request->facility_id));
            });
        }

        return view('rooms.overview', [
            'rooms' => $query->paginate(200)
        ]);
    }

    /**
     * @param Accommodation $accommodation
     * @param RoomType|null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Accommodation $accommodation, ?RoomType $type = null)
    {
        $this->authorize('view', $accommodation);

        $rooms = $accommodation->rooms();
        if ($type) {
            $rooms->where('room_type_id', $type->id);
        }

        return view('rooms.index', [
            'rooms' => $rooms->orderBy(\DB::raw("NULLIF(regexp_replace(floor, '\D', '', 'g'), '')::int"))->orderBy('name')->paginate(25),
            'accommodation' => $accommodation,
            'type' => $type,
        ]);
    }

    /**
     * @param Accommodation|null $accommodation
     * @param RoomType|null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(?Accommodation $accommodation = null, ?RoomType $type = null)
    {
        $this->authorize('create', Room::class);

        $form = $this->form(RoomsForm::class, [
            'method' => 'POST',
            'url' => route('rooms.store'),
        ]);

        $form->setFormOption('enctype', 'multipart/form-data');
        $form->add('file', 'file', [
            'label' => 'Photos',
            'attr' => ['multiple' => true, 'class' => 'form-control-file']
        ]);

        if ($accommodation) {
            $form->getField('accommodation_id')
                ->setOption('selected', $accommodation->id);
        }

        if ($type) {
            $form->getField('room_type_id')
                ->setOption('selected', $type->id);
        }

        return view('rooms.create', [
            'form' => $form,
            'accommodation' => $accommodation,
            'type' => $type,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Room::class);

        $form = $this->form(RoomsForm::class);
        $form->redirectIfNotValid();

        foreach ($form->getField('name')->getValue() as $name) {
            $room = new Room();
            $room->fill($form->getFieldValues());
            $room->name = $name;
            $room->accommodation_id = request()->accommodation_id;
            $room->save();

            $room->facilities()->sync($form->getFieldValues()['facilities'] ?? []);

            app()->get(PhotosController::class)->upload($request, $room);
        }

        flash('Successfully created')->success();

        return redirect()->route('rooms', [$room->accommodation, $room->roomType]);
    }

    /**
     * @param Room $room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Room $room)
    {
        $this->authorize('view', $room);

        $form = $this->form(RoomForm::class, [
            'model' => $room,
        ]);

        $this->staticForm($form);

        return view('rooms.show', [
            'form' => $form,
            'room' => $room,
        ]);
    }

    /**
     * @param Room $room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Room $room)
    {
        $this->authorize('update', $room);

        $form = $this->form(RoomForm::class, [
            'method' => 'POST',
            'url' => route('rooms.update', $room),
            'model' => $room,
        ]);
        $form->remove('accommodation_id');

        return view('rooms.edit', [
            'room' => $room,
            'form' => $form,
        ]);
    }

    /**
     * @param Room $room
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Room $room)
    {
        $this->authorize('update', $room);

        $form = $this->form(RoomForm::class);
        $form->remove('accommodation_id');
        $form->redirectIfNotValid();

        $room->fill($form->getFieldValues());
        $room->facilities()->sync($form->getFieldValues()['facilities'] ?? []);
        $room->save();

        flash('Successfully saved')->success();

        return redirect()->route('rooms.show', $room);
    }

    /**
     * @param Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Room $room)
    {
        $this->authorize('delete', $room);

        $room->forceDelete();

        flash("Room '{$room->name}' deleted.")->success();

        return redirect()->route('rooms', $room->accommodation, $room->roomType);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function floors()
    {
        $builder = new Select2Builder(
            Room::select('floor')
                ->from(Room::selectQuery()->select('floor')->distinct(), 'r')
        );

        $builder->setSelectColumns('floor', 'floor');
        $builder->setOrder(\DB::raw("NULLIF(regexp_replace(floor, '\D', '', 'g'), '')::int"));

        return $builder->make();
    }
}
