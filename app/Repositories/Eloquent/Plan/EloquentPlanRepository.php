<?php


namespace App\Repositories\Eloquent\Plan;


use App\Models\Plan;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\PlanRepositoryInterface;

class EloquentPlanRepository extends EloquentBaseRepository implements PlanRepositoryInterface
{
    protected $model = Plan::class;
    
    
}