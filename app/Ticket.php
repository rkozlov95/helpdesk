<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
    'user_id', 'ticket_id', 'subject', 'message', 'status', 'path'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasManagerComments()
    {
        return $this->comments->reduce(function ($acc, $item) {
            $isManagerComment = User::all()->find($item->user_id)->isManager();
            return $isManagerComment || $acc;
        }, false);
    }
}
