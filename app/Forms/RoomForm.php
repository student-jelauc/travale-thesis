<?php


namespace App\Forms;


use App\Entities\Accommodations\Accommodation;
use App\Entities\Accommodations\RoomType;
use App\Entities\Geography\City;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class RoomForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('accommodation_id', 'select2', [
                'rules' => 'required',
                'label' => 'Accommodation',
                'choices' => Accommodation::whereAccountId(\Auth::user()->account_id)->pluck('name', 'id'),
                'empty_value' => '- Accommodation -',
            ])
            ->add('floor', 'text', [
                'rules' => 'required',
                'tags' => true,
            ])
            ->add('room_type_id', 'select2', [
                'rules' => 'required',
                'label' => 'Room Type',
                'choices' => RoomType::whereAccountId(\Auth::user()->account_id)->orWhereNull('account_id')->pluck('name', 'id'),
                'empty_value' => '- Room Type -',
            ])
            ->add('name[]', 'select2', [
                'label' => 'Room names',
                'rules' => ['required', Rule::unique('rooms')->where(function ($query) {
                    $query->where('accommodation_id', request()->input('accommodation_id'))
                        ->whereIn('name', request()->input('name'));
                })],
                'multiple' => true,
                'tags' => true,
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
        ;
    }
}
