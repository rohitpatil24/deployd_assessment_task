<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError(error: 'Validation Error : ' . $validator->errors()->first(), code: 403);
        }

        $credentials = $request->only('username', 'password');

        $token = JWTAuth::attempt($credentials);

        if (!$token) {
            throw new AuthenticationException();
        }

        $user = JWTAuth::user();

        $data = [
            'user'      => JWTAuth::user(),
            'token'     => $token,
            'tokenType' => 'bearer',
        ];

        return $this->sendResponse($data, 'User logged in successfully!');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|alpha_dash:ascii',
            'email'    => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:6',
            'contact'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError(error: 'Validation Error : ' . $validator->errors()->first(), code: 403);
        }

        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'contact'  => $request->contact,
        ]);

        $token = JWTAuth::attempt(['username' => $request->username, 'password' => $request->password]);

        $data = [
            'user'      => JWTAuth::user(),
            'token'     => $token,
            'tokenType' => 'bearer',
        ];

        return $this->sendResponse(result: $data, message: 'User created successfully.');
    }

    public function logout()
    {
        JWTAuth::logout();
        return $this->sendResponse(message: 'User created successfully.');
    }

    public function refresh()
    {
        $data = [
            'user'          => JWTAuth::user(),
            'authorisation' => [
                'token' => JWTAuth::refresh(),
                'type'  => 'bearer',
            ],
        ];

        return $this->sendResponse(result: $data, message: 'Token refreshed.');
    }

}
