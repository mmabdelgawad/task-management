<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Api\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request, LoginAction $action): UserResource
    {
        [$token, $user] = $action->handle($request->validated());

        return UserResource::make($user)->setToken($token);
    }
}
