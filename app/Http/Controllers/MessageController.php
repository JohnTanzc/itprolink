<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\MessageSent;


class MessageController extends Controller
{

    // Fetch all conversations (users who have sent or received messages with the authenticated user)
    public function message(Request $request)
    {
        $userId = auth()->id();

        // Retrieve users with the count of unread messages and the latest message
        $conversations = User::where('id', '!=', $userId)
            ->withCount([
                'receivedMessages as unread' => function ($query) use ($userId) {
                    $query->where('read', false)->where('sender_id', $userId);
                }
            ])
            ->with([
                'lastMessage' => function ($query) use ($userId) {
                    $query->where(function ($q) use ($userId) {
                        $q->where('sender_id', $userId)
                            ->orWhere('receiver_id', $userId);
                    });
                }
            ])  // Eager load lastMessage for each conversation
            ->get();

        // Retrieve all conversations for the sidebar
        $conversations = User::where('id', '!=', $userId)
            ->withCount([
                'receivedMessages as unread' => function ($query) use ($userId) {
                    $query->where('read', false)->where('sender_id', $userId);
                }
            ])
            ->get()
            ->map(function ($user) use ($userId) {
                // Fetch the last message between the authenticated user and the conversation user
                $lastMessage = Message::where(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $userId)->where('receiver_id', $user->id);
                })
                    ->orWhere(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $user->id)->where('receiver_id', $userId);
                })
                    ->latest() // Order by the latest message
                    ->first();

                // Attach the last message to the user
                $user->lastMessage = $lastMessage;

                return $user;
            })
            ->sortByDesc(function ($user) {
                // Sort by the latest message created_at time
                // If no message exists, consider it as a very old date to appear last
                return $user->lastMessage ? $user->lastMessage->created_at : now()->subYears(100);
            });



        // Optional: Handle search
        if ($search = $request->input('search')) {
            $conversations = $conversations->filter(function ($user) use ($search) {
                return stripos($user->fname, $search) !== false;
            });
        }

        // Pass conversations to the view, and initialize $messages and $receiver as empty values
        $messages = [];  // Empty by default
        $receiver = null;  // Make sure $receiver is null

        return view('dash.dashmessage', compact('conversations', 'messages', 'receiver'));
    }



    // Fetch conversation messages between the authenticated user and the selected user
    public function fetchConversation($id, Request $request)
    {
        $userId = auth()->id();

        // Fetch messages between the authenticated user and the other user
        $messages = Message::where(function ($query) use ($userId, $id) {
            $query->where('sender_id', $userId)->where('receiver_id', $id);
        })
            ->orWhere(function ($query) use ($userId, $id) {
                $query->where('sender_id', $id)->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return response()->json($messages); // Return JSON response for AJAX
        }

        // Fetch the receiver user
        $receiver = User::find($id);

        // Retrieve all conversations for the sidebar
        $conversations = User::where('id', '!=', $userId)
            ->withCount([
                'receivedMessages as unread' => function ($query) use ($userId) {
                    $query->where('read', false)->where('sender_id', $userId);
                }
            ])
            ->get()
            ->map(function ($user) use ($userId) {
                $lastMessage = Message::where(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $userId)->where('receiver_id', $user->id);
                })
                    ->orWhere(function ($query) use ($userId, $user) {
                        $query->where('sender_id', $user->id)->where('receiver_id', $userId);
                    })
                    ->latest()
                    ->first();

                $user->lastMessage = $lastMessage;
                return $user;
            })
            ->sortByDesc(function ($user) {
                return $user->lastMessage ? $user->lastMessage->created_at : now()->subYears(100);
            });

        if ($search = $request->input('search')) {
            $conversations = $conversations->filter(function ($user) use ($search) {
                return stripos($user->fname, $search) !== false;
            });
        }

        // Return the Blade view for non-AJAX requests
        return view('dash.dashmessage', compact('conversations', 'messages', 'receiver'));
    }




    // Send a message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);



        return response()->json(['status' => 'success']);
    }

    public function showMessage($id)
    {
        // Fetch the message from the database
        $selectedMessage = Message::findOrFail($id);

        // Pass it to the view
        return view('dash.dashmessage', compact('selectedMessage'));
    }
}
