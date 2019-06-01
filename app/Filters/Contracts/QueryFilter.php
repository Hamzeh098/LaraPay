<?php

namespace App\Filters\Contracts;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;
    protected $builder;

    public function __construct()
    {
        $this->request = Request::capture();
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $key => $value) {
            if (!method_exists($this, $key)) {
                return 0;
            }
            !empty($value) ? $this->{$key}($value) : $this->{$key}();
        }

        return $this->builder;
    }

    protected function filters()
    {
        return $this->request->all();
    }
}