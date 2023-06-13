<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\ToDoList;

class IndexController extends Controller
{
    public function __invoke(int $listId)
    {
        $list = ToDoList::find($listId );
        $tasks = Task::select('id', 'title', 'description', 'list_id')
            ->with(['image' => function ($query) {
                $query->select('id', 'url', 'preview_url', 'task_id');
            }])
            ->where('list_id', '=', $list->id)
            ->get();
        return view('task.index',
            compact('list', 'tasks'));
    }
}
