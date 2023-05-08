<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData  = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'unique:users,email', 'max:255', new MyEmailRule],
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $response = [
            'user' => $user,
        ];

        // return response($response, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($login)) {
            return redirect('/login')->with('notification', [
                'color' => 'red',
                'title' => 'Failed',
                'message' => 'Invalid login credentials!',
            ]);
        }

        $token = Auth::user()->createToken('authToken')->accessToken;
        $user = Auth::user();

        // $response = [
        //     'access_token' => $token,
        //     'user' => new UserResource($user),
        // ];

        // return response($response, Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::user()->token()->revoke();

        // return response(['message' => 'Logged out successfully!'], Response::HTTP_OK);
    }
}
