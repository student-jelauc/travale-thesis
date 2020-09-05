<?php


namespace App\Forms;


use App\Entities\Geography\City;
use Kris\LaravelFormBuilder\Form;

class AccommodationForm extends Form
{
    /**
     * @var bool
     */
    protected $clientValidationEnabled = false;

    public function buildForm()
    {
        $this
            ->add('city_id', 'select2', [
                'rules' => 'required',
                'label' => 'Location',
                'choices' => City::with('country')->get()->reduce(function (&$carry, $city) {
                    $carry[$city->id] = "{$city->country->name} - {$city->name}";
                    return $carry;
                }, []),
                'empty_value' => '- City -',
            ])
            ->add('name', 'text', [
                'rules' => 'required',
            ])
            ->add('description', 'textarea')
        ;
    }
}
