<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Message;
use App\Models\User;
use App\Models\Server;

class APIController extends Controller
{
    public function setUser(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        return response($user, 201);
    }

    public function getUser(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if ($user && Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
    }

    public function getAllUsers(){
        $users = User::all();
        return response($users, 200);
    }

    public function setMessage(Request $request){
        $fields = $request->validate([
            'content' => 'required|string',
            'sender_name' => 'required|string',
            'server_id' => 'required|integer'
        ]);

        $message = Message::create([
            'content' => $fields['content'],
            'sender_name' => $fields['sender_name'],
            'server_id' => $fields['server_id']
        ]);

        return response($message, 201);
    }

    public function getMessagesByServerId($server_id){
        $messages = Message::where('server_id', $server_id)->get();
        return response($messages, 200);
    }

    public function getAllMessages(){
        $messages = Message::all();
        return response($messages, 200);
    }

    public function getAllServers(){
        $servers = Server::all();
        return response($servers, 200);
    }



}
