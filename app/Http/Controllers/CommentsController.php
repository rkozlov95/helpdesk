<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Grosv\LaravelPasswordlessLogin\LoginUrl;
use App\Mail\CommentsShipped;
use Mail;

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

        $managerEmail = env('MAIL_USERNAME');

        $manager = User::find(1);
        $generator = new LoginUrl($manager);
        $generator->setRedirectUrl('/tickets/' . $comment->ticket_id);
        $url = $generator->generate();

        Mail::to($managerEmail)->send(new CommentsShipped($comment, $url));

        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
