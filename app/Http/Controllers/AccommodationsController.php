<?php


namespace App\Http\Controllers;


use App\Entities\Accommodations\Accommodation;
use App\Forms\AccommodationForm;
use Kris\LaravelFormBuilder\Fields\SelectType;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class AccommodationsController extends Controller
{
    use FormBuilderTrait;

    public function index()
    {

    }

    public function create()
    {
        $form = $this->form(AccommodationForm::class);

        return view('accommodations.create', [
            'form' => $form,
        ]);
    }

    public function show(Accommodation $accommodation)
    {
        $form = $this->form(AccommodationForm::class, [
            'model' => $accommodation,
        ]);

        foreach ($form->getFields() as $field) {
            $form->remove($field->getName());
            if (in_array($field->getName(), ['api_username', 'api_password'])) {
                continue;
            } elseif ($field instanceof SelectType) {
                $form->add($field->getName(), 'static', [
                    'label' => $field->getOption('label'),
                    'value' => @$field->getOption('choices', [])[$field->getValue()],
                ]);
            } else {
                $form->add($field->getName(), 'static', [
                    'label' => $field->getOption('label'),
                ]);
            }
        }
        $form->disableFields();

        return view('accommodations.view', [
            'form' => $form,
        ]);
    }
}
