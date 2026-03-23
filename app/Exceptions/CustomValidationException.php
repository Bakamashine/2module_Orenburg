<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


class CustomValidationException extends ValidationException
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Invalid fields',
            'errors' => $this->validator->errors()->getMessages()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
