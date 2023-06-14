<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
    public const TAGS = 'tags';

    protected function getCallbacks(): array
    {
        return [
            self::TAGS => [$this, 'tags'],
        ];
    }

    public function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function ($query) use ($value){
            $query->whereIn('tag_id', $value);
        });
    }
}
