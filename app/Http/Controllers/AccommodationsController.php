<?php


namespace App\Http\Controllers;


use App\Entities\Accommodations\Accommodation;
use App\Forms\AccommodationForm;
use App\Forms\Helpers\FormBuilderTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        $this->authorizeResource(Accommodation::class, 'accommodation');
    }

    public function index()
    {
        $accommodations = Accommodation::orderBy('name')->paginate(10);

        return view('accommodations.index', [
            'accommodations' => $accommodations,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
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
        $form = $this->form(AccommodationForm::class);
        $form->redirectIfNotValid();

        $accommodation = new Accommodation();
        $accommodation->fill($form->getFieldValues());
        $accommodation->account_id = \Auth::user()->account_id;
        $accommodation->save();

        flash('Successfully created')->success();

        app()->get(PhotosController::class)->upload($request,'accommodation', $accommodation);

        return redirect()->route('accommodations.show', $accommodation);
    }

    /**
     * @param Accommodation $accommodation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Accommodation $accommodation)
    {
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
        $accommodation->forceDelete();

        flash("Accommodation '{$accommodation->name}' deleted.")->success();

        return redirect()->route('accommodations');
    }
}
