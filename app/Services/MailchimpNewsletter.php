<?php

namespace App\Services;

use Illuminate\Support\Arr;
use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    private ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function subscribe($email, $list = null)
    {
        $list ??= config('services.mailchimp.lists.test');
        $list = Arr::first(
            $this->client->lists->getAllLists()->lists,
            fn($value) => $value->name === $list
        );
        $this->client->lists->addListMember($list->id, [
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }
}
