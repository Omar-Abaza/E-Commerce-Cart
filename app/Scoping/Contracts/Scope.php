<?php
namespace App\Scoping\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface Scope
{
    public function apply(Builder $builder, $value);

}