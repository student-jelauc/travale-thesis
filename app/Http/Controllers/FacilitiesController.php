<?php


namespace App\Http\Controllers;


use App\Entities\Accommodations\Facility;
use App\Forms\FacilityForm;
use App\Forms\Helpers\FormBuilderTrait;
use App\Forms\RoomTypeForm;
use App\Helpers\Select2Builder;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    use FormBuilderTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Facility::class);

        return view('facilities.index', [
            'form' => $this->form(FacilityForm::class),
            'types' => Facility::selectQuery()->orderBy('rating', 'desc')->orderBy('name')->paginate(25),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Facility::class);

        $form = $this->form(FacilityForm::class);
        $form->redirectIfNotValid();

        $facility = new Facility();
        $facility->fill($form->getFieldValues());
        $facility->account_id = \Auth::user()->account_id;
        $facility->save();

        flash("'$facility->name' has been successfully saved")->success();

        return redirect()->back();
    }

    /**
     * @param Facility $facility
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Facility $facility)
    {
        $this->authorize('delete', $facility);

        $facility->delete();

        flash("'$facility->name' has been successfully deleted")->success();

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function select()
    {
        $this->authorize('viewAny', Facility::class);

        $builder = new Select2Builder(Facility::selectQuery());

        return $builder->make();
    }
}
