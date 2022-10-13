<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'isbn', 'author', 'status'];

    public function scopeFilter(Builder $builder, QueryFilter $filters){
        return $filters->apply($builder);
    }
}
