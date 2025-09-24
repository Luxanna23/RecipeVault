<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function register(RegisterRequest $request)
    {
        $validated = $this->authService->register($request->validated());

        return response()->json($validated, 201);
    }
  
    public function login(LoginRequest $request)
    {
        $validated = $this->authService->login($request->validated());

        return response()->json($validated);
    }

}