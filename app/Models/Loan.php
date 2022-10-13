<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['due_date', 'user_id', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        $builder->join('books', 'loans.book_id', '=', 'books.id');
        $builder->join('users', 'loans.user_id', '=', 'users.id');
        $builder->select(
            'loans.id',
            'books.title',
            'books.author',
            'users.name',
            'users.email',
            'loans.created_at',
            'loans.due_date',
            'loans.book_id',
            'loans.user_id'
        );
        return $filters->apply($builder);
    }
}
