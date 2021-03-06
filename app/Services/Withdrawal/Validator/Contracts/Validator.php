<?php


namespace App\Services\Withdrawal\Validator\Contracts;


use App\Services\Withdrawal\WithdrawalRequest;

abstract class Validator
{
    /**
     * @var Validator
     */
    protected $nextValidator;
    
    public function __construct(Validator $validator = null)
    {
        
        $this->nextValidator = $validator;
    }
    
    final public function handle(WithdrawalRequest $request)
    {
        $result = $this->process($request);
        if ($result) {
            if ( ! is_null($this->nextValidator)) {
                return $this->nextValidator->handle($request);
            }
            
            return true;
        }
        
        return null;
    }
    
    abstract public function process(WithdrawalRequest $request );
}