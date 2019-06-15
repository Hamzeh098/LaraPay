<?php

namespace App\Http\Controllers\Api\Contract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    protected $statusCode;

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondNotFound($message)
    {
        return $this
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    public function respondInvalidParams($message)
    {
        return $this
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message);
    }

    public function respondItemCreated($message)
    {
        return $this
            ->setStatusCode(Response::HTTP_CREATED)
            ->respondeWithSuccess($message);
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    private function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message'    => $message,
                'statusCode' => $this->getStatusCode(),
            ],
        ]);
    }

    private function respondeWithSuccess($message)
    {
        return $this->respond([
            'success' => [
                'message'     => $message,
                'statusCode' => $this->getStatusCode(),
            ],
        ]);
    }
}
