<?php


namespace App\Filters\Contracts;


trait Filterable
{
    public function scopeFilters($query, QueryFilter $queryFilter)
    {
        return $queryFilter->apply($query);
    }
}