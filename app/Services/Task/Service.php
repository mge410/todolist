<?php

namespace App\Services\Task;

use App\Models\Image;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store(array $data): Task|string
    {
        try {
            DB::beginTransaction();

            $task_image = $data['image'];
            unset($data['image']);

            $task = Task::Create($data);

            $data_image = $this->createImage($task_image, $task->list_id);

            Image::create([
                'path' => $data_image['image_path'],
                'url' => url('/storage/' . $data_image['image_path']),
                'preview_url' => url('/storage/images/task/'
                    . $task->list_id
                    . '/' . $data_image['preview_image_name']),
                'task_id' => $task->id,
            ]);

            DB::commit();
            return Task::where('id', '=', $task->id)
                ->select('id', 'title', 'description', 'list_id')
                ->with(['image' => function ($query) {
                    $query->select('id', 'url', 'preview_url', 'task_id');
                }])->first();

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function update(array $data, Task $task): Task|string
    {
        try {
            DB::beginTransaction();
            $task->update($data);

            if (isset($data['image']))
            {
                $new_image = $data['image'];
                unset($data['image']);

                $task_image = Image::where('task_id', '=', $task->id)->first();

                $data_image = $this->createImage($new_image, $task->list_id);

                $task_image->update([
                    'path' => $data_image['image_path'],
                    'url' => url('/storage/' . $data_image['image_path']),
                    'preview_url' => url('/storage/images/task/'
                        . $task->list_id
                        . '/' . $data_image['preview_image_name']),
                ]);
            }
            DB::commit();
            return Task::where('id', '=', $task->id)
                ->select('id', 'title', 'description', 'list_id')
                ->with(['image' => function ($query) {
                    $query->select('id', 'url', 'preview_url', 'task_id');
                }])->first();

        } catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function createImage(UploadedFile $new_image, int $catalog_number) : array
    {
        $image_name = md5(
                Carbon::now() . '_' . $new_image->getClientOriginalName())
            . '.' . $new_image->getClientOriginalExtension();

        $image_path = Storage::disk('public')
            ->putFileAs('/images/task/' . $catalog_number,
                $new_image,
                $image_name
            );
        \Intervention\Image\Facades\Image::make($new_image)
            ->fit(150, 150)
            ->save(storage_path('app/public/images/task/' . $catalog_number . '/'
                . 'preview_' . $image_name));

        return [
            'image_name' => $image_name,
            'image_path' => $image_path,
            'preview_image_name' =>  'preview_' . $image_name,
            'preview_image_path' => 'preview_' .$image_path,
        ];
    }
}
