<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
class ChatController extends Controller
{
    //
    public function index()
    {
        return view('chat.index');
    }
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }
    public function sendMessage(Request $request)
    {
        $m=auth()->user()->messages()->create([
            'message'=>$request->message
        ]);
        broadcast(new MessageSent($m->load('user')))->toOthers();
        return ['status'=>'success'];
    }

}
