<?php

namespace Jackabox\DuplicateField;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Field;

class DuplicateField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'duplicate-field';

    public function __construct(string $name, string $attribute = null, $resolveCallback = null)
    {
        parent::__construct(null, null, null);

        $this->onlyOnIndex();
    }
}
