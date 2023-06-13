<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request, int $listId)
    {
        $data = $request->validated();
        $data['list_id'] = $listId;

        $task = $this->service->store($data);

        return response()->json([
            'success' => 'Task created successfully',
            'data' => $task
        ], 201);
    }
}
