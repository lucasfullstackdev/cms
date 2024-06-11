<?php

namespace App\Domains;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'success' => false,
      'errors'  => $validator->errors(),
      'data'    => $this->all(),
    ], Response::HTTP_BAD_REQUEST));
  }
}
