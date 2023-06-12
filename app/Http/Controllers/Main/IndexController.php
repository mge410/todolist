<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ToDoList;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $toDoList = ToDoList::where('admin_id', '=', auth()->user()->id)
            ->get(['title', 'description']);
        return view('main.index', compact('toDoList'));
    }
}
