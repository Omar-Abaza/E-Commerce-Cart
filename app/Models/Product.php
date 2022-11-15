<?php

namespace App\Models;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeWithScopes(Builder $builder, $scopes = [])
    {
        return (new Scoper(request()))->apply($builder,$scopes );
    }


}
