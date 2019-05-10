<?php


namespace App\Repositories\Eloquent\Gateway;


use App\Models\Gateway;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\GatewayRepositoryInterface;

class EloquentGatewayRepository extends EloquentBaseRepository implements GatewayRepositoryInterface
{
    protected $model = Gateway::class;
    
    
    public function search(string $term)
    {
        return $this->model::where('gateway_title','like',"%{$term}%")
            ->get(['gateway_id as id','gateway_title as text']);
    }
}