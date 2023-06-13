<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\UpdateRequest;
use App\Models\ToDoList;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, int $listID)
    {
        $data = $request->validated();
        $list = ToDoList::find($listID);
        $list->update($data);
        return response()->json([
            'data' => $list,
            'success' => 'ToDoList changed successfully',
        ]);
    }
}
