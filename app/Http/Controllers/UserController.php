<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all()
    {
        $users = User::all();
        return view('welcome', [
            'users' => $users
        ]);
    }
    public function addPage(Request $request)
    {
        return view('create-user');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required',
            'credintial' => 'required|mimes:json'
        ]);
        if ($request->hasFile('credintial')) {
            $file = $request->file('credintial');
            $name = time() . uniqid(time()) . '.' . $file->getClientOriginalExtension();
            $path = public_path('/') . 'credential/';
            $file->move($path, $name);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'credintial' => $name
            ]);
        }
        return redirect()->route('user.all')->with('success', 'User created successfully');
    }
}
