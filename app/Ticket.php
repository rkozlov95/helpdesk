<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
    'user_id', 'ticket_id', 'subject', 'priority', 'message', 'status'
    ];
}
