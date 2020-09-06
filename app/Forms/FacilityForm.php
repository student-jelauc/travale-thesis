<?php


namespace App\Forms;


use Kris\LaravelFormBuilder\Form;

class FacilityForm extends Form
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
        $this->setFormOption('template', 'vendor.laravel-form-builder.form-default');

        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'label_attr' => ['class' => 'mr-2', 'for' => $this->name],
            ])
            ->add('rating', 'text', [
                'rules' => 'required|numeric|min:0',
                'label_attr' => ['class' => 'ml-3 mr-2', 'for' => $this->name],
                'default_value' => 50,
            ])
        ;
    }
}
