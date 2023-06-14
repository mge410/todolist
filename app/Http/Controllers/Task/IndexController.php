<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Filters\TaskFilter;
use App\Http\Requests\Task\FilterRequest;
use App\Models\Task;
use App\Models\ToDoList;

class IndexController extends Controller
{
    public function __invoke(FilterRequest $request, int $listId)
    {
        $data = $request->validated();
        $filter = app()->make(
            TaskFilter::class,
            ['queryParams' => array_filter($data)]
        );
        $list = ToDoList::find($listId);

        $tasks = Task::select('id')->where('list_id', '=', $list->id)->get();
        $tags = $tasks->pluck('tags')->flatten()->unique('id');

        $tasks = Task::select('id', 'title', 'description', 'list_id')
            ->with(['image' => function ($query) {
                $query->select('id', 'url', 'preview_url', 'task_id');
            }])
            ->with(['tags' => function ($query) {
                $query->select('tags.id', 'tags.title');
            }])
            ->where('list_id', '=', $list->id)
            ->filter($filter)
            ->get();

        return view('task.index',
            compact('list', 'tasks', 'tags'));
    }
}
