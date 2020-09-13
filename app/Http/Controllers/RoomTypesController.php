<?php


namespace App\Http\Controllers;


use App\Entities\Accommodations\RoomType;
use App\Forms\Helpers\FormBuilderTrait;
use App\Forms\RoomTypeForm;
use App\Helpers\Select2Builder;
use Illuminate\Http\Request;

class RoomTypesController extends Controller
{
    use FormBuilderTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('room-types.index', [
            'form' => $this->form(RoomTypeForm::class),
            'types' => RoomType::selectQuery()->orderBy('name')->paginate(25),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $form = $this->form(RoomTypeForm::class);
        $form->redirectIfNotValid();

        $type = new RoomType();
        $type->fill($form->getFieldValues());
        $type->account_id = \Auth::user()->account_id;
        $type->save();

        flash("'$type->name' has been successfully saved")->success();

        return redirect()->back();
    }

    /**
     * @param RoomType $type
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(RoomType $type)
    {
        $this->authorize('delete', $type);

        $type->delete();

        flash("'$type->name' has been successfully deleted")->success();

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function select()
    {
        $builder = new Select2Builder(RoomType::selectQuery());
        $builder->setOrder('name');

        return $builder->make();
    }
}
