<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use App\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers',
        ]);
        $user = Auth::user();
        $user->newsletters()->create([
            'email' => $request->input('email'),
        ]);

        return response->json(['status' => 'Successfully Subscribed the newsletter']);
    }

    public function unsubscribe(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = Auth::user();
        $user->newsletters()->where('email', $request->input('email'))->delete();
        return response->json(['status' => 'Successfully unsubscribed the newsletter']);

    }
}
