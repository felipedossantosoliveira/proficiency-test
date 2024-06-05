<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AuthController
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createToken(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken(
                $request->get('name', 'Personal Access Token'), expiresAt: now()->addDays(7)
            )->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $user = auth()->user();
            $expires_at = now()->addDays(1);
            $token = $user->createToken(
                $request->get('name', 'Personal Access Token'), expiresAt: $expires_at
            )->plainTextToken;

            return response()->json([
                'token' => $token,
                'expires_at' => $expires_at,
                'user' => $user,
            ]);
        }

    }

    /**
     * @return JsonResponse
     */
    public function listTokens(): JsonResponse
    {
        $tokens = auth()->user()->tokens->map(function ($token) {
            return [
                'id' => $token->id,
                'name' => $token->name,
                'last_used_at' => $token->last_used_at,
                'expires_at' => $token->expires_at,
            ];
        });

        return response()->json($tokens);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function revokeToken(Request $request): JsonResponse
    {
        $request->validate(['id' => 'required']);

        $token = auth()->user()->tokens()->find($request->id);

        if (! $token) {
            return response()->json(['message' => 'Token not found'], 404);
        }

        $token->delete();

        return response()->json(['message' => 'Token revoked']);
    }
}
