<?php

namespace Jackabox\DuplicateField\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class DuplicateController extends Controller
{
    /**
     * Duplicate a nova field and all of the relations defined.
     */
    public function duplicate(Request $request)
    {
        // Replicate the model
        $model = $request->model::where('id', $request->id)->first();
        
        if (!$model) {
            return [
                'status' => 404,
                'message' => 'No model found.',
                'destination' => config('nova.url') . config('nova.path') . '/resources/' . $request->resource . '/'
            ];
        }
        
        $newModel = $model->replicate();
        $newModel->push();
        
        if (isset($request->relations) && !empty($request->relations)) {
            // load the relations
            $model->load($request->relations);
            
            foreach ($model->getRelations() as $relation => $items) {
                $relation_data = $model->{$relation}();
                switch(get_class($relation_data)){
                    case BelongsToMany::class:
                    case MorphToMany::class:
                        foreach ($items as $item) {
                            $pivot = $item->pivot;
                            unset($pivot->id);
                            unset($pivot->created_at);
                            unset($pivot->updated_at);
                            
                            $foreignPivotKey = $relation_data->getForeignPivotKeyName();
                            unset($pivot->{$foreignPivotKey});
                            $relatedPivotKey = $relation_data->getRelatedPivotKeyName();
                            unset($pivot->{$relatedPivotKey});
                            
                            $newModel->{$relation}()->attach($item->id , $pivot->toArray());
                        }
                        break;
                    case HasMany::class:
                    case HasOne::class:
                    case MorphMany::class:
                    case MorphOne::class:
                        foreach ($items as $item) {
                            // clean up our models, remove the id and remove the appends
                            unset($item->id);
                            $item->setAppends([]);
                            
                            // create a relation on the new model with the data.
                            $newModel->{$relation}()->create($item->toArray());
                        }
                        break;
                    default:
                        return [
                            'status' => 404,
                            'message' => 'This relation is not supported',
                            'destination' => config('nova.url') . config('nova.path') . '/resources/' . $request->resource . '/'
                        ];
                        break;
                }
            }
        }
        
        // return response and redirect.
        return [
            'status' => 200,
            'message' => 'Done',
            'destination' => url(config('nova.path') . '/resources/' . $request->resource . '/' . $newModel->id)
        ];
    }
}