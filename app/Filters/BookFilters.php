<?php


namespace App\Filters;

class BookFilters extends QueryFilter
{
    public function isbn($isbn)
    {
        return $this->builder->where('isbn', 'LIKE', $isbn . '%');
    }

    public function title($title)
    {
        return $this->builder->where('title', 'LIKE', '%' . $title . '%');
    }

    public function author($author)
    {
        return $this->builder->where('author', 'LIKE', '%' . $author . '%');
    }

    public function status($status)
    {
        return $this->builder->where('status', $status);
    }
}
