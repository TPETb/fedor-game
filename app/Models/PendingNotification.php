<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingNotification extends Model
{
    protected $table = 'pending_notifications';

    protected $attributes = [
        'psid' => null,
        'last_played_at' => null,
    ];
}
