<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        try {
            Newsletter::create([
                'email' => $validated['email'],
                'is_subscribed' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }

    public function unsubscribe($email)
    {
        try {
            $newsletter = Newsletter::where('email', $email)->first();

            if (! $newsletter) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email not found in our newsletter list.',
                ], 404);
            }

            $newsletter->update([
                'is_subscribed' => false,
                'unsubscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'You have been unsubscribed from our newsletter.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}
