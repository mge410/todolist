<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, int $listID, int $taskId)
    {
        $data = $request->validated();

        $task = Task::find($taskId);
        $task = $this->service->update($data, $task);

        return response()->json([
            'data' => $task,
            'success' => 'ToDoList changed successfully',
        ]);
    }
}
