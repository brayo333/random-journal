<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Rules\MyEmailRule;
use App\Rules\MyPasswordRule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData  = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'unique:users,email', 'max:255', new MyEmailRule],
            'password' => ['required', 'string', 'confirmed', new MyPasswordRule],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        if (empty($user)) {
            return redirect('/register')->with('notification', [
                'color' => 'red',
                'title' => 'Failed',
                'message' => 'There was an error with creating an account. Please try again.',
            ]);
        } else {
            return redirect('/login')->with('notification', [
                'color' => 'green',
                'title' => 'Success',
                'message' => 'Your account was created successfully! You may now login.',
            ]);
        }

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

        return redirect('/journal');

        // $response = [
        //     'access_token' => $token,
        //     'user' => new UserResource($user),
        // ];

        // return response($response, Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        Auth::guard('web')->logout();

        return redirect('/')->with('notification', [
            'color' => 'green',
            'title' => 'Success',
            'message' => 'Logged out successfully!',
        ]);

        // return response(['message' => 'Logged out successfully!'], Response::HTTP_OK);
    }
}
