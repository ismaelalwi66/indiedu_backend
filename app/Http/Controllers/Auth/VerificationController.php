<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Link Expired or Not Valid'
            ]);
        } else {

            $userId = $request->route('id');
            $user = User::findOrFail($userId);

            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Email already verified'
                ]);
            } elseif ($user->markEmailAsVerified()) {
                event(new Verified($request->user()));

                return response()->json([
                    'status' => 'Success',
                    'message' => 'Email has been verified'
                ]);
            } else {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Link Expired or Not Valid'
                ]);
            }
        }
    }

    public function sendVerificationEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unknown Request'
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Already Verified'
            ]);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'Success',
            'message' => 'verification-link-sent'
        ]);
    }
}
