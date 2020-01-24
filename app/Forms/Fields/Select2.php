<?php


namespace App\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;
use Kris\LaravelFormBuilder\Fields\SelectType;

class Select2 extends SelectType
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.select2';
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
        $attr['id'] = uniqid();
        $this->setOption('attr', $attr);
        $this->setOption('id', $attr['id']);
        $this->setOption('tags', $this->getOption('tags', false));

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
