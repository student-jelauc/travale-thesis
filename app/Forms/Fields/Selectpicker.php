<?php


namespace App\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;
use Kris\LaravelFormBuilder\Fields\SelectType;

class Selectpicker extends SelectType
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.selectpicker';
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
        $attr = $this->getOption('attr', []);
        $attr['class'] = "{$attr['class']} selectpicker";
        $this->setOption('attr', $attr);

        return parent::render($options, $showLabel, $showField, $showError);
    }
}