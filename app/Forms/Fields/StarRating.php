<?php


namespace App\Forms\Fields;


use Kris\LaravelFormBuilder\Fields\FormField;

class StarRating extends FormField
{
    /**
     * @inheritdoc
     */
    public function render(array $options = [], $showLabel = true, $showField = true, $showError = false)
    {
        $this->setupStaticOptions($options);
        return parent::render($options, $showLabel, $showField, $showError);
    }

    /**
     * Setup static field options.
     *
     * @param array $options
     * @return void
     */
    private function setupStaticOptions(&$options)
    {
        $options['elemAttrs'] = $this->formHelper->prepareAttributes($this->getOption('attr'));
    }

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.star_rating';
    }

    /**
     * @inheritdoc
     */
    protected function getDefaults()
    {
        return [
            'attr' => ['id' => $this->getName(), 'class' => '']
        ];
    }
}
