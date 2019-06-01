<?php


namespace App\Services\GatewayTransaction\Verifier\contracts;



use App\Services\GatewayTransaction\TransactionVerifiyRequest;

abstract class Verifier
{
    /**
     * @var Validator
     */
    protected $nextValidator;

    public function __construct(Validator $validator = null)
    {

        $this->nextValidator = $validator;
    }

    final public function handle(TransactionVerifiyRequest $request)
    {
        $result = $this->process($request);
        if ($result) {
            if (!is_null($this->nextValidator)) {
                return $this->nextValidator->handle($request);
            }

            return true;
        }

        return null;
    }

    abstract public function process(TransactionVerifiyRequest $request);
}