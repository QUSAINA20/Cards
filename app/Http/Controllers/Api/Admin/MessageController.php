<?php

namespace App\Http\Controllers\Api\Admin;

use App\Events\AdminRepliedToMessage;
use App\Http\Controllers\Controller;
use App\Mail\AdminReplyMail;
use App\Models\AdminMessage;
use App\Models\Message;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function __construct()
    {
        \Config::set('auth.defaults.guard', 'admin-api');
    }

    public function getGuestsMessages()
    {
        $messages = Message::paginate(10);
        if ($messages->isEmpty()) {
            return response()->json(['messages' => []]);
        }
        return response()->json(['messages' => $messages]);
    }

    public function getGuestMessage($id)
    {
        $message = Message::findOrFail($id);
        return response()->json(['message' => $message]);
    }

    public function getUsersMessages()
    {
        $messages = UserMessage::with(('user'))->paginate(10);
        if ($messages->isEmpty()) {
            return response()->json(['messages' => []]);
        }
        return response()->json(['messages' => $messages]);
    }

    public function getUserMessage($id)
    {
        $message = UserMessage::findOrFail($id);
        return response()->json(['message' => $message]);
    }

    public function updateGuestStatusMessage(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pendding,Starred,Important,Draft,Trached',
        ]);
        $message = Message::findOrFail($id);
        $message->update([
            'status' => $request->status,
        ]);
        return response()->json(["message status changed to {$request->status}"]);
    }

    public function updateUserStatusMessage(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pendding,Starred,Important,Draft,Trached',
        ]);
        $message = UserMessage::findOrFail($id);
        $message->update([
            'status' => $request->status,
        ]);
        return response()->json(["message status changed to {$request->status}"]);
    }

    public function replayToGuest(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|string',
        ]);
        $message = Message::findOrFail($id);

        $adminReply = AdminMessage::create([
            'admin_id' => auth()->user()->id, // Assuming you have an admin authentication system
            'email' => auth()->user()->email,
            'subject' => 'Re: ' . $message->subject,
            'content' => $request->content,
        ]);

        // Dispatch the event to send the email
        Mail::to($message->email)->send(new AdminReplyMail($request->content, 'Re: ' . $message->subject));

        return response()->json(['message' => 'Reply sent to guest and saved as admin message successfully']);
    }

    public function replayToUser(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|string',
        ]);
        $userMessage = UserMessage::findOrFail($id);

        AdminMessage::create([
            'admin_id' => auth()->user()->id,
            'user_id' => $userMessage->user_id,
            'email' => auth()->user()->email,
            'subject' => 'Re: ' . $userMessage->subject,
            'content' => $request->input('content'),
        ]);

        return response()->json(['message' => 'Admin message stored for the user successfully']);
    }
}
