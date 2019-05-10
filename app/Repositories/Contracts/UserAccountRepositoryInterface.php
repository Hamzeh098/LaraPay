<?php


namespace App\Repositories\Contracts;


interface UserAccountRepositoryInterface extends RepositoryInterface
{
    public function search(string $item);
    
    
}