<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        try {
            $response = $this->userService->post("login", $request->all());

            $cookie = cookie('jwt', $response['data']['accessToken'], 60 * 24); // 1 day

            return response([
                'message' => 'User logged in successfully, cookie set.'
            ])->withCookie($cookie);
        } catch (\Exception $e) {
            return response([
                'message' => json_decode($e->getMessage())
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout()
    {
        try {
            $cookie = \Cookie::forget('jwt');

            $this->userService->post('logout', []);

            return response([
                'message' => 'User logged out successfully, cookie deleted.'
            ])->withCookie($cookie);
        }
        catch (\Exception $e) {
            return response()->error(json_decode($e->getMessage()), Response::HTTP_UNAUTHORIZED);
        }
    }
}
