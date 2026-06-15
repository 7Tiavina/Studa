<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'sender_id',
        'type',
        'title',
        'message',
        'action_url',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Obtenir l'utilisateur destinataire de la notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir l'utilisateur auteur de l'action de la notification.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
