<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors()
            ], 400);
        } else {
            $user = request(['email', 'password']);
            if (Auth::attempt($user)) {
                $user = User::where('email', $request->email)->first();
                $token = $user->createToken('authtoken');

                return response()->json([
                    'status' => 'Success',
                    'massage' => 'Login Successful',
                    'token' => $token->plainTextToken,
                    'data' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Login Failed'
                ], 401);
            }
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'logout success'
        ]);
    }
}
