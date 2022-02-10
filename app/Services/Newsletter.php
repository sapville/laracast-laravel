<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;
use GuzzleHttp\Exception\ClientException;

class Newsletter
{
    private ApiClient $client;

    public function __construct()
    {

        $this->client = new ApiClient();

        $this->callAPI(
            fn() => $this->client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us14'
            ])
        );

    }

    public function subscribe($email, $list = null)
    {
        $list ??= config('services.mailchimp.list');
        $this->callAPI(
            function ($args) {

                $list = Arr::first(
                    $this->client->lists->getAllLists()->lists,
                    fn($value) => $value->name === $args['list']
                );
                $this->client->lists->addListMember($list->id, [
                    "email_address" => $args['email'],
                    "status" => "subscribed",
                ]);
            },
            ['email' => $email, 'list' => $list]
        );
    }

    private function callAPI(callable $callback, array $args = [])
    {
        try {

            $callback($args);

        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents());
            throw ValidationException::withMessages(['email' => $error->title]);
        } catch (Exception $e) {
            throw ValidationException::withMessages(['email' => 'Error when subscribing']);
        }

    }

    /**
     * @return ApiClient
     */
    public function getClient(): ApiClient
    {
        return $this->client;
    }
}
