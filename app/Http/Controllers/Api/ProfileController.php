<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{

    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware(['auth:api',]);
    }
    public function profile()
    {
        $user = JWTAuth::user();
        return $this->sendResponse(result: $user, message: 'User retrieved successfully.');
    }
}
