<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthException extends Exception
{
    public static function invalidCredentials(): self
    {
        return new self('Invalid credentials.', Response::HTTP_UNAUTHORIZED);
    }

    public static function unauthorized(): self
    {
        return new self('Unauthorized.', Response::HTTP_FORBIDDEN);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
