<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
class NewsletterController 
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:subscriptions,email',
            'frequency' => 'required|in:minute,hour,midnight',
            'cryptocurrency_tickers' => 'nullable|array',
            'percentage_change_alert' => 'required|numeric|min:1',
        ]);

        $subscription = new Subscription();
        $subscription->name = $request->name;
        $subscription->email = $request->email;
        $subscription->frequency = $request->frequency;
        $subscription->cryptocurrency_tickers = implode(',', $request->cryptocurrency_tickers);
        $subscription->percentage_change_alert = $request->percentage_change_alert;
        $subscription->save();

        return view('success');
    }

    public function unsubscribe($email)
    {
        $subscription = Subscription::where('email', $email)->first();

        if ($subscription) {
            $subscription->delete();

            return view('unsubscribed');
        } else {
            abort(404);
        }
    }
}
