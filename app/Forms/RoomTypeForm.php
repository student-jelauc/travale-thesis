<?php


namespace App\Forms;


use App\Entities\Geography\City;
use Kris\LaravelFormBuilder\Form;

class RoomTypeForm extends Form
{
    /**
     * @var bool
     */
    protected $clientValidationEnabled = false;

    /**
     * @return mixed|void
     */
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required',
            ])
        ;
    }
}
