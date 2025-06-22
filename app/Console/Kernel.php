<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $this->fetchAndSendNewsletters('minute');
        })->everyMinute();
    
        $schedule->call(function () {
            $this->fetchAndSendNewsletters('hour');
        })->hourly();
    
        $schedule->call(function () {
            $this->fetchAndSendNewsletters('midnight');
        })->dailyAt('00:00');
    }

    protected function fetchAndSendNewsletters($frequency)
    {
        $subscriptions = Subscription::where('frequency', $frequency)->get();
    
        Log::info('Fetched ' . $subscriptions->count() . ' subscriptions for frequency: ' . $frequency);
    
        try {
            $cryptocurrencyData = Http::get('https://api.coinlore.net/api/tickers/?start=0&limit=100')->json()['data'];
        } catch (\Throwable $e) {
            Log::error('Failed to fetch cryptocurrency data: ' . $e->getMessage());
            return; // Stop further execution if API fails
        }
    
        foreach ($subscriptions as $subscription) {
            $content = $this->prepareNewsletterContent($subscription, $cryptocurrencyData);

            Log::info('Generated content for ' . $subscription->email . ': ' . $content);

            Mail::to($subscription->email)->send(new NewsletterMail($content));
        }

    }
    protected function prepareNewsletterContent($subscription, $cryptocurrencyData)
    {
    $tickers = explode(',', $subscription->cryptocurrency_tickers);

    $content = view('newsletter', [
        'subscription' => $subscription,
        'cryptocurrencyData' => $cryptocurrencyData,
        'tickers' => $tickers,
    ])->render();

    if (empty($content)) {
        Log::error('Newsletter content is empty. Check if the view file exists and is being rendered correctly.');
        return;
    }
    return $content;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
