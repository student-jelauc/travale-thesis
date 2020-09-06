<?php


namespace App\Forms;


use App\Entities\Accommodations\AccommodationType;
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
        $cities = City::with('country')->get()->reduce(function (&$carry, $city) {
            $carry[$city->id] = "{$city->country->name} - {$city->name}";
            return $carry;
        }, []);
        sort($cities);

        $this
            ->add('city_id', 'select2', [
                'rules' => 'required',
                'label' => 'Location',
                'choices' => $cities,
                'empty_value' => '- City -',
            ])
            ->add('name', 'text', [
                'rules' => 'required',
            ])
            ->add('stars', 'star_rating')
            ->add('type_id', 'select2', [
                'rules' => 'required',
                'label' => 'Type',
                'choices' => $types = AccommodationType::selectQuery()->pluck('name', 'id')->sortBy('name')->toArray(),
                'default_value' => array_key_first(array_filter($types, function ($value) { return $value === 'Hotel'; })),
                'empty_value' => '- Type -',
            ])
            ->add('description', 'textarea')
        ;
    }
}
