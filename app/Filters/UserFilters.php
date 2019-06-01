<?php

namespace App\Filters;


use App\Filters\Contracts\QueryFilter;

class UserFilters extends QueryFilter
{
    public function name($value)
    {
        $this->builder->where('name', "LIKE", "%{$value}%");
    }
}