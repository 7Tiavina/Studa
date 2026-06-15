<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Envoie une notification à un utilisateur.
     *
     * @param int $userId ID du destinataire
     * @param string $type Type de notification (ex: 'new_message', 'meeting_booked', etc.)
     * @param string $title Titre court de la notification
     * @param string $message Message descriptif
     * @param string|null $actionUrl URL optionnelle de redirection
     * @param int|null $senderId ID de l'auteur de l'action
     * @return \App\Models\Notification
     */
    public static function send(int $userId, string $type, string $title, string $message, ?string $actionUrl = null, ?int $senderId = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'sender_id' => $senderId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
            'is_read' => false,
        ]);
    }
}
