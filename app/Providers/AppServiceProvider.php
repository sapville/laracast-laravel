<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use App\Services\SomeOtherNewsletter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {
            $apiKey = config('services.mailchimp.key');
            if ($apiKey)
                return new MailchimpNewsletter(
                    (new ApiClient())->setConfig([
                        'apiKey' => $apiKey,
                        'server' => 'us14'
                    ])
                );
            else
                return new SomeOtherNewsletter();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
