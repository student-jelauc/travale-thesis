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
        $this->setFormOption('class', 'form-inline');
        $this->setFormOption('method', 'POST');
        $this->setFormOption('template', 'vendor.laravel-form-builder.form');

        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'label' => false,
            ])
        ;
    }
}
