<?php


namespace App\Forms;


use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\Facility;
use App\Entities\Accommodations\RoomType;
use App\Entities\Geography\City;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class RoomsForm extends Form
{
    /**
     * @var bool
     */
    protected $clientValidationEnabled = false;

    public function buildForm()
    {
        $this
            ->add('accommodation_id', 'select2', [
                'rules' => 'required',
                'label' => 'Accommodation',
                'choices' => Accommodation::whereAccountId(\Auth::user()->account_id)->pluck('name', 'id')->toArray(),
                'empty_value' => '- Accommodation -',
            ])
            ->add('name', 'select2', [
                'label' => 'Room names',
                'choices' => array_combine($name = request('name', session()->getOldInput('name', [])), $name),
                'rules' => 'required|array',
                'attr' => ['multiple' => 'multiple'],
                'tags' => true,
                'selected' => function ($data) use ($name) {
                    return $name;
                },
            ])
            ->add('floor', 'text', [
                'rules' => 'required',
                'tags' => true,
            ])
            ->add('room_type_id', 'select2', [
                'rules' => 'required',
                'label' => 'Room Type',
                'choices' => RoomType::selectQuery()->pluck('name', 'id')->toArray(),
                'empty_value' => '- Room Type -',
            ])
            ->add('facilities', 'select2', [
                'rules' => 'required',
                'label' => 'Facilities',
                'choices' => Facility::selectQuery()->pluck('name', 'id')->toArray(),
                'attr' => ['multiple' => 'multiple'],
            ])
            ->add('adults_capacity', 'text', [
                'rules' => 'required|numeric|min:0',
                'default_value' => 2,
            ])
            ->add('children_capacity', 'text', [
                'rules' => 'required|numeric|min:0',
                'default_value' => 0,
            ])
            ->add('infants_capacity', 'text', [
                'rules' => 'required|numeric|min:0',
                'default_value' => 0,
            ])
            ->add('description', 'textarea');
    }
}
