<?php


namespace App\Filters;

class UserFilters extends QueryFilter
{

    public function email($email)
    {
        return $this->builder->where('email', $email);
    }

    public function name($name)
    {
        return $this->builder->where('name', 'LIKE', '%' . $name . '%');
    }

    public function status($status)
    {
        return $this->builder->where('status', $status);
    }

    public function role($role)
    {
        return $this->builder->where('role', $role);
    }

    public function createdfrom($createdfrom)
    {
        return $this->builder->whereDate('created_at', '>', $createdfrom);
    }

    public function createdto($createdto)
    {
        return $this->builder->whereDate('created_at', '<', $createdto);
    }
}
