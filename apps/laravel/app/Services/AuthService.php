<?php

namespace App\Services;

use stdClass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Validation\ValidationException;

class AuthService 
{
    /**
     * Function for registring a new user
     *
     * @param RegisterUserRequest $request
     * @return stdClass
     */
    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated + ['password' => Hash::make($request->password)]);
        $token = $user->createToken('api-token')->plainTextToken;

        return (object)[
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Function for login user
     *
     * @param LoginUserRequest $request
     * @return stdClass
     */
    public function login(LoginUserRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return (object) [
            'user' => $user,
            'token' => $token
        ];
    }
}