@extends('layouts.app')

@section('subject', $ticket->subject)

@section('content')
    @auth
    <div class="row">
        <div class="col-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                {{ session()->get('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <form id="accept_form" method="POST" action="{{ url('accept_ticket/' . $ticket->id)}}">
                        <div class="float-left">#{{ $ticket->id }} - {{ $ticket->subject }}</div>
                        {!! csrf_field() !!}
                        @if($ticket->manager_id)
                            <div class="float-right"> Manager: {{ $nameManager }} </div>
                        @else
                            @can('accept', $ticket)
                                <a onclick="document.getElementById('accept_form').submit();" class="float-right" role="submit" href="#">
                                Accept ticket
                                </a>
                            @endcan
                        @endif
                    </form>
                </div>
                <div class="card-body">
                    <div class="ticket-info">
                        <p>Creator E-Mail: {{ $ticket->user->email }}</p>
                        <p>Message: {{ $ticket->message }}</p>
                        @if ($ticket->status === 'Open')
                            Status: <span class="badge badge-success">{{ $ticket->status }}</span>
                        @else
                            Status: <span class="badge badge-danger">{{ $ticket->status }}</span>
                        @endif
                        </p>
						<p>Attachment - <a href="{{ asset('/storage/uploads/' . $ticket->path) }}">{{ $ticket->path }}</a>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>

                    @if(!$comments->isEmpty())
                    <div class="comments">
                        <p>Comments:</p>
                        @foreach ($comments as $comment)
                            <div class="panel panel-heading">
                                {{ $comment->user->name }}
                                <span class="pull-right">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="panel panel-body">
                                {{ $comment->comment }}
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    @endif

                    @if($ticket->status !== "Closed")
                    <div class="comment-form">
                        <form method="POST" class="form">
                            {!! csrf_field() !!}
                            <p>New comment:</p>
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="7" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button formaction="{{ url('comment') }}" class="btn btn-primary">
                                    Comment
                                </button>
                                <button formaction="{{ url('close/' . $ticket->id) }}" class="btn btn-danger float-right">
                                    Close ticket
                                </button>
                            </div>
                        </form>
                   </div>
                   @endif
            </div>
        </div>
    </div>
    @endauth
@endsection
