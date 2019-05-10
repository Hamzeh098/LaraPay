<?php


namespace App\Presenters\Contacts;

use phpDocumentor\Reflection\Types\This;
use mysql_xdevapi\Exception;

trait Presentable
{
    protected $presenterInstance;
    
    public function present()
    {
        if ( ! $this->presenter || ! class_exists($this->presenter)) {
            throw new Exception('presenter not found');
        }
        
        if ( ! $this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }
        
        return $this->presenterInstance;
    }
}