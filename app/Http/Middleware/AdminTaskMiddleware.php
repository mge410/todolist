<?php

namespace App\Http\Middleware;

use App\Models\ToDoList;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminTaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $list = ToDoList::find($request->route('list_id'));
//        dd($request->route());
        if ($list->admin_id == $request->user()->id)
        {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
