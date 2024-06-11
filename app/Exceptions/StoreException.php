<?php

namespace App\Exceptions;

use App\Dtos\Dto;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class StoreException extends Exception
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function __construct(string $message, private ?string $errors = null, private ?Dto $data = null)
    {
        parent::__construct($message, $this->code);
    }

    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors' => $this->errors,
            'data' => $this->data?->toArray()
        ], $this->getCode());
    }
}
