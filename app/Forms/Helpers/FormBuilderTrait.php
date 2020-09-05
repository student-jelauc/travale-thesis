<?php


namespace App\Forms\Helpers;


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
            $form->remove($field->getName());

            if ($field->getType() === 'star_rating') {
                $form->add($field->getName(), $field->getType());
            } elseif (in_array($field->getName(), ['api_username', 'api_password'])) {
                continue;
            } elseif ($field instanceof \Kris\LaravelFormBuilder\Fields\SelectType) {
                $form->add($field->getName(), 'static', [
                    'label' => $field->getOption('label'),
                    'value' => @$field->getOption('choices', [])[$field->getValue()],
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
