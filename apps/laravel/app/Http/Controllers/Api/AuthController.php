<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        public AuthService $authService
    ) {}

    /**
     * Registering a new user
     *
     * @param Request $request
     * @return void
     */
    public function register(RegisterUserRequest $request)
    {
        $service = $this->authService->register($request);

        return response()
            ->json([
                'message' => 'Пользователь успешно зарегистрирован',
                'user' => $service->user,
                'token' => $service->token
            ], 201);
    }

    /**
     * Login of user
     *
     * @param LoginUserRequest $request
     * @return void
     */
    public function login(LoginUserRequest $request)
    {
        $service = $this->authService->login($request);

        return response()
            ->json([
                'message' => 'Успешный вход',
                'user' => $service->user,
                'token' => $service->token
            ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
            ->json([
                'message' => 'Выход выполнен'
            ]);
    }
}
