<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * Endpoint: POST /api/register
     * Expects JSON body: { name, email, password, password_confirmation }
     * Returns JSON: { token, user: { ... } }
     */
    public function register(Request $request)
    {
        // 1) Validate input:
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // 2) Create user:
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role'     => 'user',  // default role
        ]);

        // 3) Generate JWT token for this user:
        $token = JWTAuth::fromUser($user);

        // 4) Return token + user data:
        return response()->json([
            'token' => $token,
            'user'  => $user,  // hides password & remember_token automatically
        ], 201);
    }

    /**
     * Login an existing user.
     *
     * Endpoint: POST /api/login
     * Expects JSON body: { email, password }
     * Returns JSON: { token, user: { ... } }
     */
    public function login(Request $request)
    {
        // 1) Validate input:
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only(['email', 'password']);

        try {
            // 2) Attempt to verify credentials and create a token:
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Invalid credentials'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }

        // 3) If successful, retrieve the user and return token + user data:
        $user = JWTAuth::user();
        return response()->json([
            'token' => $token,
            'user'  => $user,
        ], 200);
    }

    /**
     * Log out (invalidate) the current token.
     *
     * Endpoint: POST /api/logout
     * Requires header: Authorization: Bearer {token}
     * Returns JSON: { message: "Successfully logged out" }
     */
    public function logout(Request $request)
    {
        try {
            // 1) Invalidate the token (so it can no longer be used):
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Failed to logout, please try again.'
            ], 500);
        }
    }

    /**
     * (Optional) Get the currently authenticated user.
     *
     * Endpoint: GET /api/me
     * Requires header: Authorization: Bearer {token}
     * Returns JSON: { user: { ... } }
     */
    public function me(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token invalid or expired'], 401);
        }

        return response()->json([
            'user' => $user
        ]);
    }
}