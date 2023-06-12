<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\StoreRequest;
use App\Models\ToDoList;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['admin_id'] = auth()->user()->id;
        $list = ToDoList::Create($data);
        return response()->json([
            'success' => 'ToDoList created successfully',
            'data' => $list
        ], 201);
    }
}
