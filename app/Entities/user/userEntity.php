<?php


namespace App\Entities\user;


class userEntity
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $balance;
    private $mobile;
    private $email_token;
    private $status;
    private $created_at;
    private $updated_at;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param  mixed  $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param  mixed  $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param  mixed  $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param  mixed  $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
    
    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }
    
    /**
     * @param  mixed  $balance
     */
    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }
    
    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }
    
    /**
     * @param  mixed  $mobile
     */
    public function setMobile($mobile): void
    {
        $this->mobile = $mobile;
    }
    
    /**
     * @return mixed
     */
    public function getEmailToken()
    {
        return $this->email_token;
    }
    
    /**
     * @param  mixed  $email_token
     */
    public function setEmailToken($email_token): void
    {
        $this->email_token = $email_token;
    }
    
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param  mixed  $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
    
    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * @param  mixed  $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }
    
    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    
    /**
     * @param  mixed  $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    
    
}