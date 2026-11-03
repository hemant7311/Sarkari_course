<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate($validated);
        if ($subscriber->unsubscribed_at) {
            $subscriber->update(['unsubscribed_at' => null]);
        }

        return back()->with('newsletter_status', 'Aap successfully subscribe ho gaye hain!');
    }

    public function unsubscribe(string $token): RedirectResponse
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->firstOrFail();
        $subscriber->update(['unsubscribed_at' => now()]);

        return redirect()->route('home')->with('status', 'You have been unsubscribed from newsletter updates.');
    }
}
