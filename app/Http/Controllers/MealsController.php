<?php


namespace App\Http\Controllers;


use App\Entities\Stays\Meal;
use App\Forms\Helpers\FormBuilderTrait;
use App\Forms\RoomTypeForm;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    use FormBuilderTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Meal::class);

        return view('meals.index', [
            'form' => $this->form(RoomTypeForm::class),
            'types' => Meal::selectQuery()->orderBy('name')->paginate(25),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('viewAny', Meal::class);

        $form = $this->form(RoomTypeForm::class);
        $form->redirectIfNotValid();

        $meal = new Meal();
        $meal->fill($form->getFieldValues());
        $meal->account_id = \Auth::user()->account_id;
        $meal->save();

        flash("'$meal->name' has been successfully saved")->success();

        return redirect()->back();
    }

    /**
     * @param Meal $meal
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Meal $meal)
    {
        $this->authorize('delete', $meal);

        $meal->delete();

        flash("'$meal->name' has been successfully deleted")->success();

        return redirect()->back();
    }
}
