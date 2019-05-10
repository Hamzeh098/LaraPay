<?php


namespace App\Services\Gateway;


use App\Helpers\Hash\generateHash;
use App\Repositories\Contracts\GatewayRepositoryInterface;

class createGatewayService
{
    /**
     * @var createGatewayRequest
     */
    private $createGatewayRequest;
    private $gatewayRepository;
    
    public function __construct(createGatewayRequest $createGatewayRequest)
    {
        $this->createGatewayRequest   =$createGatewayRequest;
        $this->gatewayRepository = resolve(GatewayRepositoryInterface::class);
    }
    
    public function perform()
    {
        $newGateway = $this->gatewayRepository->store(
            [
                'gateway_plan'         => $this->createGatewayRequest->getPlanID(),
                'gateway_user_id'      => $this->createGatewayRequest->getUserID(),
                'gateway_title'        => $this->createGatewayRequest->getTitle(),
               // 'gateway_website'      => $this->createGatewayRequest->getWebsite(),
                'access_token' => $this->createAccessToken(),
                'gateway_default_bank' => $this->createGatewayRequest->getBank(),
                'gateway_status'       => $this->createGatewayRequest->getStatus(),
            ]
        );
        return $newGateway;
    }
    
    private function createAccessToken()
    {
        return generateHash::make();
    }
    
}