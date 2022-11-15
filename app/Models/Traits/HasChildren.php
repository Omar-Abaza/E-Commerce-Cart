<?php

namespace App\Models\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasChildren
{
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
}
