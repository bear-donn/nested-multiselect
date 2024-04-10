<?php

namespace Beardonn\NestedMultiselect;

use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Util;

class NestedMultiselect extends MultiSelect
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nested-multiselect';

    public function options($options)
    {
        $this->optionsCallback = json_encode($options);

        return $this;
    }

    protected function serializeOptions()
    {
        /** @var TOption $options */
        $options = value($this->optionsCallback);

        if (is_callable($options)) {
            $options = $options();
        }

        return collect($options ?? [])->map(function ($label, $value) {
            $value = Util::safeInt($value);

            return is_array($label) ? $label + ['id' => $value] : ['label' => $label, 'id' => $value];
        })->values()->all();
    }
}
