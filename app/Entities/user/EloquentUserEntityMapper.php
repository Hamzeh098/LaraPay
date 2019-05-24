<?php


namespace App\Entities\user;


use App\Models\User;

class EloquentUserEntityMapper extends userEntity
{
    private $entityClass;
    private $userModel;
    
    public function __construct(User $user)
    {
        $this->userModel   = $user;
        $this->entityClass = new userEntity();
    }
    
    private function setupEntity()
    {
        $this->entityClass->setId($this->userModel->id);
        $this->entityClass->setName($this->userModel->name);
        $this->entityClass->setEmail($this->userModel->email);
        $this->entityClass->setPassword($this->userModel->password);
        $this->entityClass->setMobile($this->userModel->mobile);
        $this->entityClass->setBalance($this->userModel->balance);
        $this->entityClass->setEmailToken($this->userModel->email_token);
        $this->entityClass->setStatus($this->userModel->status);
        $this->entityClass->setCreatedAt($this->userModel->created_at);
        $this->entityClass->setUpdatedAt($this->userModel->updated_at);
    }
    
    public function getEntity()
    {
        $this->setupEntity();
        return $this->entityClass;
    }
}