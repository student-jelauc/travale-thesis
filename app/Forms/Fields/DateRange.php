<?php


namespace App\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class DateRange extends FormField
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.date_range';
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
        return parent::render($options, $showLabel, $showField, $showError);
    }
}