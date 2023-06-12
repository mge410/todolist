<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\DestroyRequest;
use App\Models\Task;

class DestroyController extends Controller
{
    public function __invoke(DestroyRequest $request)
    {
        $data = $request->validated();
        Task::find($data['id'])->delete();
        return response()->json([
            'success_deleted' => 'Task deleted successfully'
        ], 201);
    }
}
