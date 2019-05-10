<?php


namespace App\Repositories\Contracts;


interface GatewayRepositoryInterface extends RepositoryInterface
{
    public function search(string $term);
}