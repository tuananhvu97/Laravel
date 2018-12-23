<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class SendMessageController extends Controller
{
    public function index()
    {
        return view('send_message');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
        
        $data['title'] = $request->input('title');
        $data['message'] = $request->input('message');

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'send-message', $data);

        return redirect()->route('send');
    }
}
