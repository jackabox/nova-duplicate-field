<?php

namespace Jackabox\DuplicateField\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DuplicateController extends Controller
{

    public function duplicate(Request $request)
    {
        $model = $request->model::where('id', $request->id)->first();
        $newModel = $model->replicate();
        $newModel->save();

        return [
            'status' => 200,
            'message' => 'Done',
            'destination' => config('nova.url') . config('nova.path') . '/resources/' . $request->resource . '/' . $newModel->id . '/edit'
        ];
    }

}
