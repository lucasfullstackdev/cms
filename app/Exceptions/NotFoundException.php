<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends Exception
{
    protected $code = Response::HTTP_NOT_FOUND;

    public function __construct(string $message, private ?string $identifier = null)
    {
        parent::__construct($message, $this->code);
    }

    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
            'data' => $this?->identifier
        ], $this->getCode());
    }
}
