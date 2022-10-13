<?php


namespace App\Filters;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class LoanFilters extends QueryFilter
{
    public function book($book)
    {
        return $this->builder->where('title', 'LIKE', '%' . $book . '%');
    }

    public function member($member)
    {
        return $this->builder->where('name', 'LIKE', '%' . $member . '%');
    }

    public function created_at($date)
    {
        return $this->builder->where('loans.created_at', '>=', $date);
    }

    public function due_date($date)
    {
        return $this->builder->where('loans.due_date', '<=', $date);
    }
}
