<?php


namespace App\Repositories\Contracts;


interface GatewayRepositoryInterface extends RepositoryInterface
{
    public function search(string $term);

    public function incrBalance(int $id, int $amount);
}