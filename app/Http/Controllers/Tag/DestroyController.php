<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\DestroyRequest;
use App\Models\Tag;
use App\Models\Task;
use App\Models\ToDoList;

class DestroyController extends Controller
{
    public function __invoke(DestroyRequest $request, int $listId, int $postId)
    {
        $data = $request->validated();
        $tag = Tag::find($data['id']);
        $task = Task::find($postId);

        $task->tags()->detach($tag);

        return response()->json([
            'success_deleted' => 'Tag deleted successfully',
        ], 201);
    }
}
