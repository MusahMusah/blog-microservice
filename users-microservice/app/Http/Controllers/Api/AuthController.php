<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->success(
            [
                'user' => $user
            ],
            'User registered successfully',
            Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request)
    {
        // Authenticate the user via LoginRequest
        $request->authenticate();


        if ($request->user()->is_admin) {
            // Create a token for the admin
            $token = $request->user()->createToken('accessToken', ['admin']);
        } else {
            // Create a token for the user
            $token = $request->user()->createToken('accessToken', ['user']);
        }

        // Return the token
        return response()->success(
            [
                'user'=> $request->user(),
                'accessToken'=> $token->plainTextToken
            ],
            'Login Successful',
            Response::HTTP_OK
        );
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->success(
            [
                'message' => 'Logged out'
            ]
        );

    }

    public function authenticate(Request $request)
    {
        if (!$request->user()) {
            abort(401, 'unauthorized');
        }

        return response()->success($request->user());
    }
}
