<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    // Create User
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|bail|email|unique:users,email,except,id',
            'password' => 'required|bail|min:6',
        ]);

        try {
            // Create new user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            // Response
            return response()->json([
                'message' => 'Success'
            ], 200);
        } catch (\Throwable $th) {
            // Response
            return response()->json([
                'message' => 'Error !'
            ], 500);
        }
    }

    // Login
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'bail|required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Get User
            $user = Auth::user();

            // create user api_token
            $token = Str::random(60);

            User::where('id', $user->id)->where('email', $user->email)->update([
                'api_token' => hash('sha256', $token)
            ]);

            return response()->json([
                'message' => 'logged in as ' . $user->name,
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'errors' => 'invalid login Details'
            ], 422);
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
