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

    public function __construct(string $name, Model $model, string $resource)
    {
        parent::__construct($name);

        $this->withMeta([
            'model_class' => get_class($model),
            'model_key_name' => $model->getKeyName(),
            'model_key_value' => $model->getKey(),
            'resource' => $resource,
        ]);

        $this->onlyOnIndex();
    }

    /**
     * @param string[] $attributes
     * @return $this
     */
    public function except(array $attributes)
    {
        return $this->withMeta(['except' => $attributes]);
    }

    /**
     * @param string[] $attributes
     * @return $this
     */
    public function override(array $attributes)
    {
        return $this->withMeta(['override' => $attributes]);
    }

    /**
     * @param string[] $relations
     * @return $this
     */
    public function relations(array $relations)
    {
        return $this->withMeta(['relations' => $relations]);
    }

    /**
     * @param string[] $except
     * @return $this
     */
    public function relationsExcept(array $except)
    {
        return $this->withMeta(['relations_except' => $except]);
    }

    /**
     * @param string[] $override
     * @return $this
     */
    public function relationsOverride(array $override)
    {
        return $this->withMeta(['relations_override' => $override]);
    }
}
