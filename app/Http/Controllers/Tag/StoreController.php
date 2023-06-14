<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;
use App\Models\Task;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, int $listId ,int $taskId)
    {
        $data = $request->validated();
        $tag = Tag::firstOrCreate($data);

        $task = Task::find($taskId);
        $task->tags()->attach($tag);

        return response()->json([
            'success' => 'ToDoList created successfully',
            'data' => $tag,
            'listId' => $listId,
            'taskId' => $taskId,
        ], 201);
    }
}
