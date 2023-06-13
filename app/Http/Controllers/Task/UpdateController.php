<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, int $listID, int $taskId)
    {
        $data = $request->validated();
        $task = Task::find($taskId);
        $task->update($data);
        return response()->json([
            'data' => $task,
            'success' => 'ToDoList changed successfully',
        ]);
    }
}
