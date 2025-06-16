<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'role' => 'required|string|in:admin,user',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8',
            ]);

            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);

            return $this->sendResponse('User registered successfully', 201, $user);
        } catch (\Exception $e) {
            return $this->sendError('Registration failed', 500, [$e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (!auth()->attempt($data)) {
                return $this->sendError('Invalid credentials', 401);
            }

            $user = auth()->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponse('Login successful', 200, ['user' => $user, 'token' => $token]);
        } catch (\Exception $e) {
            return $this->sendError('Login failed', 500, [$e->getMessage()]);
        }
    }
}
