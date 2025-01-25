<?php

namespace App\Http\Controllers;

use App\Models\Credintial;
use App\Models\ServerMail;
use App\Models\User;
use App\Services\GmailService;
use Google\Client;
use Illuminate\Http\Request;
use Google\Service\Gmail;

class GmailController extends Controller
{
    // private $client;

    // public function __construct($userId, $credintial)
    // {
    //     $this->client = new Client();
    //     $this->client->setAuthConfig(public_path('/') . 'credential/' . $credintial);
    //     $this->client->addScope(Gmail::GMAIL_SEND);
    //     $this->client->setRedirectUri(route('callback', [$userId]));
    //     $this->client->setAccessType('offline');
    // }

    public function authenticate($id)
    {
        $email = ServerMail::findOrFail($id);
        $provider = new GmailService($email->id, $email->credintial);
        return redirect()->to($provider->client->createAuthUrl());
    }


    public function callback(Request $request)
    {
        $data = json_decode($request->state);
        $code = $request->get('code');
        $email = ServerMail::findOrFail($data->id);
        $provider = new GmailService($email->id, $email->credintial);
        $accessToken = $provider->client->fetchAccessTokenWithAuthCode($code);

        // Store the access token securely (e.g., database or storage)
        $credintial = new Credintial();
        $credintial->user_id = $email->id;
        $credintial->accessToken = json_encode($accessToken);

        $credintial->save();
        return redirect()->route('server-mail.all')->with('success', 'Atuthentication Successfully');
    }
}
