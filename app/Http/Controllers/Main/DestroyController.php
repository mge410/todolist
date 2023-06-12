<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\DestroyRequest;
use App\Models\ToDoList;

class DestroyController extends Controller
{
    public function __invoke(DestroyRequest $request)
    {
        $data = $request->validated();
        ToDoList::find($data['id'])->delete();
        return response()->json([
            'success_deleted' => 'ToDoList deleted successfully'
        ], 201);
    }
}
