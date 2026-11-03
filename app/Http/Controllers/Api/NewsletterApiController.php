<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsletterApiController extends Controller
{
    /**
     * POST /api/newsletter
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate($validated);
        if ($subscriber->unsubscribed_at) {
            $subscriber->update(['unsubscribed_at' => null]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Aap successfully subscribe ho gaye hain!',
        ], 201);
    }
}
