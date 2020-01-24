<?php


namespace App\Forms\Fields;


use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Fields\FormField;

class Datepicker extends FormField
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.datepicker';
    }

    /**
     * @param array $options
     * @param bool $showLabel
     * @param bool $showField
     * @param bool $showError
     * @return string
     */
    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options['id'] = $id = 'datepicker' . uniqid();
        if (isset($options['attr']['class'])) {
            $options['attr']['class'] = $options['attr']['class'] . $id;
        } else {
            $options['attr']['class'] = "form-control $id";
        }

        return parent::render($options, $showLabel, $showField, $showError);
    }
}