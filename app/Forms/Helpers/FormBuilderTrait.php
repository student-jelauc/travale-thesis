<?php


namespace App\Forms\Helpers;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait FormBuilderTrait
{

    /**
     * Create a Form instance.
     *
     * @param string $name Full class name of the form class.
     * @param array  $options Options to pass to the form.
     * @param array  $data additional data to pass to the form.
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function form($name, array $options = [], array $data = [])
    {
        return \App::make('laravel-form-builder')->create($name, $options, $data);
    }

    /**
     * Create a plain Form instance.
     *
     * @param array $options Options to pass to the form.
     * @param array $data additional data to pass to the form.
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function plain(array $options = [], array $data = [])
    {
        return \App::make('laravel-form-builder')->plain($options, $data);
    }

    /**
     * @param \Kris\LaravelFormBuilder\Form $form
     */
    protected function staticForm(&$form)
    {
        foreach ($form->getFields() as $field) {
            $form->remove($field->getRealName());
            if ($field->getType() === 'star_rating') {
                $form->add($field->getName(), $field->getType());
            } elseif ($field->getValue() && in_array($field->getName(), ['client_id', 'partner_id', 'merchant_id', 'descriptor_id'])) {
                $form->add($field->getName(), 'ref', [
                    'label' => $field->getOption('label'),
                    'url' => route(Str::plural(str_replace('_id', '', $field->getName())) . '.show', $field->getValue()),
                    'value' => $field instanceof \Kris\LaravelFormBuilder\Fields\SelectType
                        ? @$field->getOption('choices', [])[$field->getValue()]
                        : $field->getValue(),
                ]);
            } elseif ($field instanceof \Kris\LaravelFormBuilder\Fields\SelectType) {
                $form->add($field->getName(), 'static', [
                    'label' => $field->getOption('label'),
                    'value' => implode(', ', array_intersect_key(
                        $field->getOption('choices', []),
                        array_flip(Arr::wrap($field->getValue()))
                    )),
                ]);
            } else {
                $form->add($field->getName(), 'static', [
                    'label' => $field->getOption('label'),
                ]);
            }
        }
        $form->disableFields();
    }
}
