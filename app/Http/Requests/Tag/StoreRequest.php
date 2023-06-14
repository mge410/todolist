<?php

namespace App\Http\Requests\Tag;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('tags')->where(function ($query) {
                    $task = Task::find($this->task_id);
                    return $query->whereIn('title', $task->tags->pluck('title')->toArray());
                })
            ]
        ];
    }
}
