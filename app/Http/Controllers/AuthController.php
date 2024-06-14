<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
  public function login(Login $request)
  {
    $credentials = $request->only('email', 'password');

    // Validating the credentials
    if (!auth()->attempt($credentials)) {
      abort(Response::HTTP_UNAUTHORIZED, 'Credentials');
    }

    $user = auth()->user();

    // Set session expiration time from config
    $token = $user->createToken(
      $_SERVER['HTTP_USER_AGENT'],
      ['*'],
      Carbon::now()->addMinutes(config('sanctum.expiration'))
    );

    return response()->json([
      'data' => [
        'token' => $token->plainTextToken
      ]
    ]);
  }

  // Desconection from the current device
  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
      'success' => true,
      'message' => 'Device disconnected'
    ]);
  }

  // Desconection from all devices
  public function logoutAll(Request $request)
  {
    $request->user()->tokens()->delete();

    return response()->json([
      'success' => true,
      'message' => 'All devices were disconnected'
    ]);
  }

  // Getting some important information from the authenticated user
  public function me(Request $request)
  {
    $user = $request->user();
    $currentToken = $user->currentAccessToken();
    $tokens = $user->tokens()->where('token', '!=', $user->currentAccessToken()->token);

    return response()->json([
      'data' => [
        'name' => $user->name,
        'email' => $user->email,
        'devices' => [
          'current' => $currentToken->name,
          'others' => $tokens->pluck('name')
        ]
      ]
    ]);
  }
}
