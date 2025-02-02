<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::query()
            ->orderBy('status')
            ->latest()
            ->get();
        $unread_messages = $messages->where('status', 0)->count();

        return view('admin.messages.index', compact('messages', 'unread_messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:180',
            'email' => 'required|string|lowercase|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:30|min:10',
            'message' => 'required|string|max:2000',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', "Message sent. You'll get a response soon");
    }

    public function edit(Message $message)
    {
        if($message->status == 0) {
            $message->update(['status' => 1]);
        }

        return view('admin.messages.edit', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index')->with('success', "Message has been deleted.");
    }
}
