<?php

namespace App\Services\Task;

use App\Models\Image;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            $task_image = $data['image'];
            unset($data['image']);

            $task = Task::Create($data);

            $image_name = md5(
                    Carbon::now() . '_' . $task_image->getClientOriginalName())
                . '.' . $task_image->getClientOriginalExtension();
            $preview_image_name = 'preview_' . $image_name;


            $image_path = Storage::disk('public')
                ->putFileAs('/images/task/' . $task->list_id,
                    $task_image,
                    $image_name
                );

            Image::create([
                'path' => $image_path,
                'url' => url('/storage/' . $image_path),
                'preview_url' => url('/storage/images/task/'
                    . $task->list_id
                    . '/' . $preview_image_name),
                'task_id' => $task->id,
            ]);

            \Intervention\Image\Facades\Image::make($task_image)
                ->fit(150, 150)
                ->save(storage_path('app/public/images/task/' . $task->list_id . '/' .
                    $preview_image_name));

            DB::commit();
            return $task;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

    }
}
