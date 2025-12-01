<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends BaseApiController
{
    /**
     * Login API
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors()->toArray());
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->sendUnauthorized('Invalid credentials');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return $this->sendResponse(auth('api')->user(), 'User retrieved successfully');
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return $this->sendResponse(null, 'Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return $this->sendResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], 'Authentication successful');
    }
}
