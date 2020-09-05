<?php


namespace App\Forms;


use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\RoomType;
use App\Entities\Geography\City;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class RoomForm extends Form
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
            ->add('name', 'text', [
                'rules' => 'required',
            ])
            ->add('floor', 'text', [
                'rules' => 'required',
                'tags' => true,
            ])
            ->add('room_type_id', 'select2', [
                'rules' => 'required',
                'label' => 'Room Type',
                'choices' => RoomType::whereAccountId(\Auth::user()->account_id)->orWhereNull('account_id')->pluck('name', 'id')->toArray(),
                'empty_value' => '- Room Type -',
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
        ;
    }
}
