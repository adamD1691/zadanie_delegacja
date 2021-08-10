<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse(['data' => $validator->errors(), 'message' => 'Validation error', 'success' => false], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
