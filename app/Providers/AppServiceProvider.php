<?php

namespace App\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        FormBuilder::macro('vselect2', function (
            $name,
            $list = [],
            $selected = null,
            array $selectAttributes = [],
            array $optionsAttributes = [],
            array $optgroupsAttributes = []
        ) {
            $this->type = 'v-select';

            // When building a select box the "value" attribute is really the selected one
            // so we will use that when checking the model or session for a value which
            // should provide a convenient method of re-populating the forms on post.


            // This breaks multiple options on v-select, instead of array of values, we're getting only one value
//             $selected = $this->getValueAttribute($name, $selected);


            if ($selected) {
                if (is_array($selected)) {
                    $selectAttributes[':value'] = json_encode($selected);
                } else {
                    $selectAttributes['value'] = $selected;
                }
            }

            if (isset($selectAttributes['depends-on'])) {
                $selectAttributes[':depends-on'] = json_encode($selectAttributes['depends-on']);
                unset($selectAttributes['depends-on']);
            }

            $selectAttributes['id'] = $this->getIdAttribute($name, $selectAttributes);

            if (! isset($selectAttributes['name'])) {
                $selectAttributes['name'] = $name;
            }

            // We will simply loop through the options and build an HTML value for each of
            // them until we have an array of HTML declarations. Then we will join them
            // all together into one single HTML element that can be put on the form.
            $html = [];

//            if (isset($selectAttributes['placeholder'])) {
//                $html[] = $this->placeholderOption($selectAttributes['placeholder'], $selected);
////                unset($selectAttributes['placeholder']);
//            }

            foreach ($list as $value => $display) {
                $optionAttributes = $optionsAttributes[$value] ?? [];
                $optgroupAttributes = $optgroupsAttributes[$value] ?? [];
                $html[] = $this->getSelectOption($display, $value, $selected, $optionAttributes, $optgroupAttributes);
            }

            // Once we have all of this HTML, we can join this into a single element after
            // formatting the attributes into an HTML "attributes" string, then we will
            // build out a final select statement, which will contain all the values.
            $selectAttributes = $this->html->attributes($selectAttributes);

            $list = implode('', $html);

            return $this->toHtmlString("<v-select{$selectAttributes}>{$list}</v-select>");
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
