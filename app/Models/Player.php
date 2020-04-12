<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $dates = [
        'last_played_at',
        'last_notified_at',
        'next_notification_at'
    ];
}
