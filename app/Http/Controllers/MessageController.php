<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Message $message)
    {
        //
    }

    public function destroy(Message $message)
    {
        //
    }
}
