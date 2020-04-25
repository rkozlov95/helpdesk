<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user, Ticket $ticket)
    {
        if ($user->email === 'manager@mail.ru') {
            return true;
        }
        return $user->id === $ticket->user_id;
    }
}
