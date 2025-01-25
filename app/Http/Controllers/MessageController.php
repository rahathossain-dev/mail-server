<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function all()
    {
        $messages = Message::all();
        return view('message.all', [
            'messages' => $messages
        ]);
    }

    public function add()
    {
        return view('message.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'subject'   => 'required|string|max:255',
            'body'  => 'required'
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->save();

        $id = $message->id;

        if($request->hasFile('images')){
            foreach($request->images as $image){
                $attachment = new Attachment();
                $name = md5(time()) . '_rh' . '.jpg';
                $path = public_path('/') . 'attachment/';
                $image->move($path,$name);
                
                $attachment->name = $name;
                $attachment->message_id = $id;
                $attachment->save();
                
            }
        }

        return back()->with('success','Message Save Successfully');
    }
}
