<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\ToDoList;

class IndexController extends Controller
{
    public function __invoke(int $listId)
    {
        $list = ToDoList::find($listId);
        $tasks = Task::where('list_id', '=', $list->id)
            ->get(['id', 'title', 'description']);
        return view('task.index',
            compact('list', 'tasks'));
    }
}
