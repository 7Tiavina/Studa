<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class MessageController extends Controller
{
    public function findOrCreate($partnerId)
    {
        $currentId = Auth::id();
        $partner = User::findOrFail($partnerId);
        
        $conversation = Conversation::where(function($query) use ($currentId, $partnerId) {
            $query->where('user_one_id', $currentId)->where('user_two_id', $partnerId);
        })->orWhere(function($query) use ($currentId, $partnerId) {
            $query->where('user_one_id', $partnerId)->where('user_two_id', $currentId);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $currentId,
                'user_two_id' => $partnerId,
            ]);
        }

        $data = $conversation->toArray();
        $data['partner_is_online'] = $partner->last_seen_at && $partner->last_seen_at->gt(now()->subMinutes(2));

        return response()->json($data);
    }

    public function checkStatus($userId)
    {
        $user = User::findOrFail($userId);
        $isOnline = $user->last_seen_at && $user->last_seen_at->gt(now()->subMinutes(2));
        return response()->json(['is_online' => $isOnline]);
    }

    public function checkStatuses(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        $users = User::whereIn('id', $request->ids)->get();
        $statuses = [];
        foreach ($users as $user) {
            $statuses[$user->id] = $user->last_seen_at && $user->last_seen_at->gt(now()->subMinutes(2));
        }
        return response()->json($statuses);
    }

    public function index($conversationId)
    {
        $conversation = Conversation::where('id', $conversationId)
            ->where(function($query) {
                $query->where('user_one_id', Auth::id())
                      ->orWhere('user_two_id', Auth::id());
            })->firstOrFail();

        return response()->json($conversation->messages()->with('user')->get());
    }

    public function store(Request $request, $conversationId)
    {
        $conversation = Conversation::where('id', $conversationId)
            ->where(function($query) {
                $query->where('user_one_id', Auth::id())
                      ->orWhere('user_two_id', Auth::id());
            })->firstOrFail();

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        $recipientId = $conversation->user_one_id === Auth::id() ? $conversation->user_two_id : $conversation->user_one_id;

        NotificationService::send(
            $recipientId,
            'new_message',
            'Nouveau message',
            Auth::user()->name . " vous a envoyé un message : " . substr($message->body, 0, 50) . (strlen($message->body) > 50 ? '...' : ''),
            null,
            Auth::id()
        );

        return response()->json($message->load('user'));
    }

    public function react(Request $request, Message $message)
    {
        $request->validate([
            'emoji' => 'required|string',
        ]);

        $emoji = $request->emoji;
        $userId = Auth::id();
        $reactions = $message->reactions ?: [];

        if (!isset($reactions[$emoji])) {
            $reactions[$emoji] = [];
        }

        if (in_array($userId, $reactions[$emoji])) {
            // Remove reaction
            $reactions[$emoji] = array_values(array_filter($reactions[$emoji], fn($id) => $id !== $userId));
            if (empty($reactions[$emoji])) {
                unset($reactions[$emoji]);
            }
        } else {
            // Add reaction
            $reactions[$emoji][] = $userId;
        }

        $message->update(['reactions' => $reactions]);

        return response()->json($message);
    }
}
