<?php

namespace App\Http\Controllers;

use App\Models\ServerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServerMailController extends Controller
{
    public function all()
    {
        $mails = ServerMail::all();
        return view('server-mail.all', [
            'mails' => $mails
        ]);
    }

    public function addMail()
    {
        return view('server-mail.add');
    }

    public function storeMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:server_mails,email',
            'credintial' => 'required|mimes:json'
        ]);

        $mail = new ServerMail();
        $mail->email = $request->email;

        $file = $request->file('credintial');
        $name = time() . uniqid(time()) . '.' . $file->getClientOriginalExtension();
        $path = public_path('/') . 'credintial/';
        $file->move($path, $name);

        $mail->credintial = $name;

        $mail->save();
        return back()->with('success', 'Mail Added Successfully');
    }

    public function editMail($id)
    {
        $mail = ServerMail::findOrFail($id);
        return view('server-mail.edit', [
            'mail' => $mail
        ]);
    }
    //01625946405
    public function updateMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'credintial' => 'required|mimes:json',
            'id' => 'required'
        ]);
        $mail = ServerMail::findOrFail($request->id);
        if ($mail->email == $request->email) {
            $mail->email = $request->email;
        } else {
            $request->validate([
                'email' => 'unique:server_mails,email'
            ]);
            $mail->email = $request->email;
        }

        if (file_exists(public_path('/') . 'credintial/' . $mail->credintial)) {
            File::delete(public_path('/') . 'credintial/' . $mail->credintial);
        }

        $file = $request->file('credintial');
        $name = time() . uniqid(time()) . '.' . $file->getClientOriginalExtension();
        $path = public_path('/') . 'credintial/';
        $file->move($path, $name);

        $mail->credintial = $name;

        $mail->update();
        return back()->with('success', 'Mail Update Successfully');

    }


    public function mailDelete($id)
    {
        $mail = ServerMail::findOrFail($id);

        if (file_exists(public_path('/') . 'credintial/' . $mail->credintial)) {
            File::delete(public_path('/') . 'credintial/' . $mail->credintial);
        }
    }


}
