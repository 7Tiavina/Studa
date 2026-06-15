<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Récupérer les notifications de l'utilisateur connecté.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->where('type', '!=', 'new_message')
            ->latest()
            ->take(20)
            ->get();

        $unreadCount = Notification::where('user_id', Auth::id())
            ->where('type', '!=', 'new_message')
            ->where('is_read', false)
            ->count();

        $unreadMessagesCount = Notification::where('user_id', Auth::id())
            ->where('type', 'new_message')
            ->where('is_read', false)
            ->count();

        $unreadMessagesBySender = Notification::where('user_id', Auth::id())
            ->where('type', 'new_message')
            ->where('is_read', false)
            ->selectRaw('sender_id, count(*) as count')
            ->groupBy('sender_id')
            ->pluck('count', 'sender_id')
            ->toArray();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
            'unread_messages_count' => $unreadMessagesCount,
            'unread_messages_by_sender' => (object) $unreadMessagesBySender,
        ]);
    }

    /**
     * Marquer comme lues toutes les notifications de nouveaux messages d'un expéditeur spécifique.
     */
    public function markMessagesAsReadFromSender($senderId)
    {
        Notification::where('user_id', Auth::id())
            ->where('type', 'new_message')
            ->where('sender_id', $senderId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Marquer une notification spécifique comme lue.
     */
    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Action non autorisée.'], 403);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Marquer toutes les notifications de l'utilisateur comme lues.
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
