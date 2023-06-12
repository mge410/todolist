<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, int $listId)
    {
        $data = $request->validated();
        $data['list_id'] = $listId;
        $task = Task::Create($data);
        return response()->json([
            'success' => 'Task created successfully',
            'data' => $task
        ], 201);
    }
}
