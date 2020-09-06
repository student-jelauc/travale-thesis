<?php


namespace App\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;
use Kris\LaravelFormBuilder\Fields\SelectType;

class VSelect2 extends SelectType
{
    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.vselect2';
    }
}