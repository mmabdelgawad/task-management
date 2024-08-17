<?php

namespace App\Actions\Api\Auth;

use App\Exceptions\Auth\AuthException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    /**
     * @param array $data
     * @return array
     * @throws AuthException
     */
    public function handle(array $data): array
    {
        $user = User::query()->where('email', $data['email'])->first();

        if ( ! $user || ! Hash::check($data['password'], $user->password)) {
            throw AuthException::invalidCredentials();
        }

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return [$token, $user];
    }
}
