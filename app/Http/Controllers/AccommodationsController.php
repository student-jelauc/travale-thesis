<?php


namespace App\Http\Controllers;


use App\Entities\Accommodations\Accommodation;
use App\Forms\AccommodationForm;
use App\Forms\Helpers\FormBuilderTrait;
use App\Helpers\Select2Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccommodationsController extends Controller
{
    use FormBuilderTrait;

    /**
     * AccommodationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Accommodation::class);

        $accommodations = Accommodation::with('city', 'city.country', 'type')
            ->orderBy('name')
            ->paginate(25);

        return view('accommodations.index', [
            'accommodations' => $accommodations,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Accommodation::class);

        $form = $this->form(AccommodationForm::class, [
            'method' => 'POST',
            'url' => route('accommodations.store'),
        ]);

        $form->setFormOption('enctype', 'multipart/form-data');
        $form->add('file', 'file', [
            'label' => 'Photos',
            'attr' => ['multiple' => true, 'class' => 'form-control-file']
        ]);

        return view('accommodations.create', [
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Accommodation::class);

        $form = $this->form(AccommodationForm::class);
        $form->redirectIfNotValid();

        $accommodation = new Accommodation();
        $accommodation->fill($form->getFieldValues());
        $accommodation->account_id = \Auth::user()->account_id;
        $accommodation->save();

        flash('Successfully created')->success();

        app()->get(PhotosController::class)->upload($request, $accommodation);

        return redirect()->route('accommodations.show', $accommodation);
    }

    /**
     * @param Accommodation $accommodation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Accommodation $accommodation)
    {
        $this->authorize('view', $accommodation);

        $form = $this->form(AccommodationForm::class, [
            'model' => $accommodation,
        ]);

        $this->staticForm($form);

        return view('accommodations.show', [
            'form' => $form,
            'accommodation' => $accommodation,
            'roomsTypes' => $accommodation->rooms()
                ->selectRaw('room_types.id, room_types.name, count(*) as rooms_count')
                ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
                ->groupBy('room_types.id', 'room_types.name')
                ->get()
            ,
        ]);
    }

    /**
     * @param Accommodation $accommodation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Accommodation $accommodation)
    {
        $this->authorize('update', $accommodation);

        $form = $this->form(AccommodationForm::class, [
            'method' => 'POST',
            'url' => route('accommodations.update', $accommodation),
            'model' => $accommodation,
        ]);

        return view('accommodations.edit', [
            'accommodation' => $accommodation,
            'form' => $form,
        ]);
    }

    /**
     * @param Accommodation $accommodation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Accommodation $accommodation)
    {
        $this->authorize('update', $accommodation);

        $form = $this->form(AccommodationForm::class);
        $form->redirectIfNotValid();

        $accommodation->fill($form->getFieldValues());
        $accommodation->account_id = \Auth::user()->account_id;
        $accommodation->save();

        flash('Successfully saved')->success();

        return redirect()->route('accommodations.show', $accommodation);
    }

    /**
     * @param Accommodation $accommodation
     * @return \Illuminate\Http\JsonResponse
     */
    public function photos(Accommodation $accommodation)
    {
        $this->authorize('view', $accommodation);

        return response()->json(
            $accommodation->photos->map(function ($photo) {
                return [
                    'name' => $photo->name,
                    'size' => Storage::disk('public')->size($photo->path),
                    'type' => Storage::disk('public')->mimeType($photo->path),
                    'url' => Storage::disk('public')->url($photo->path),
                ];
            })
        );
    }

    /**
     * @param Accommodation $accommodation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Accommodation $accommodation)
    {
        $this->authorize('delete', $accommodation);

        $accommodation->forceDelete();

        flash("Accommodation '{$accommodation->name}' deleted.")->success();

        return redirect()->route('accommodations');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function select()
    {
        $this->authorize('viewAny', Accommodation::class);

        $accommodations = Accommodation::selectQuery();

        $builder = new Select2Builder($accommodations);
        $builder->setOrder('name');

        return $builder->make();
    }
}
