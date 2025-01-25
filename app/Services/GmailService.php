<?php

namespace App\Services;

use Google\Client;
use Google\Service\Gmail;

class GmailService
{
    public $client;

    public function __construct($userId, $credintial)
    {
        $this->client = new Client();
        $this->client->setAuthConfig(public_path('/') . 'credintial/' . $credintial);
        $this->client->addScope(Gmail::GMAIL_SEND);
        $this->client->setRedirectUri(route('callback'));
        $this->client->setAccessType('offline');
        $state = json_encode(['id' => $userId]);
        $this->client->setState($state);
    }
}