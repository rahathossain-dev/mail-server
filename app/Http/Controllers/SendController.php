<?php

namespace App\Http\Controllers;

use App\Models\Credintial;
use App\Models\ServerMail;
use App\Models\User;
use App\Services\GmailService;
use Google\Service\Gmail;
use Illuminate\Http\Request;

class SendController extends Controller
{

    public function email()
    {
        $users = ServerMail::all();
        return view('email', [
            'users' => $users
        ]);
    }
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email_list' => 'required',
            'email' => 'required|email',
            'subject' => 'required'
        ]);
        $user = ServerMail::where('id', $request->email_list)->first();


        $credintial = Credintial::where('user_id', $user->id)->first();

        $token = json_decode($credintial->accessToken, true);

        $provider = new GmailService($user->id, $user->credintial);

        $provider->client->setAccessToken($token);

        if ($provider->client->isAccessTokenExpired()) {
            $refreshToken = $token['refresh_token'];
            $provider->client->fetchAccessTokenWithRefreshToken($refreshToken);
            $credintial->accessToken = json_encode($provider->client->getAccessToken());
            $credintial->update();
        }

        $service = new Gmail($provider->client);

        $rawMessageString = "To: $request->email\r\n";
        $rawMessageString .= "Subject: $request->subject\r\n";
        $rawMessageString .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
        $rawMessageString .= $request->body;

        $rawMessage = base64_encode($rawMessageString);
        $rawMessage = str_replace(['+', '/', '='], ['-', '_', ''], $rawMessage);

        $gmailMessage = new Gmail\Message();
        $gmailMessage->setRaw($rawMessage);

        $service->users_messages->send($user->email, $gmailMessage);
        return back()->with('success', 'Email send successfully');
    }
}
