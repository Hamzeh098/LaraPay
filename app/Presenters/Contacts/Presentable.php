<?php


namespace App\Presenters\Contacts;


trait Presentable
{
    protected $presenterInstance;
    
    public function present()
    {
        if ( ! $this->presenter || ! class_exists($this->presenter)) {
            throw new \Exception('presenter not found');
        }
        
        if ( ! $this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }
        
        return $this->presenterInstance;
    }
}