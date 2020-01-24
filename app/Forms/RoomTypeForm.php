<?php


namespace App\Forms;


use App\Entities\Geography\City;
use Kris\LaravelFormBuilder\Form;

class RoomTypeForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required',
            ])
        ;
    }
}
