<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function postComment(Request $request)
    {
        $this->validate($request, [
            'comment'   => 'required'
        ]);

        $comment = comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id'    => auth::user()->id,
            'comment'    => $request->input('comment'),
        ]);

        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
