@extends('layouts.app')

@section('subject', $ticket->subject)

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    #{{ $ticket->id }} - {{ $ticket->subject }}
                </div>

				<hr>

                <div class="panel-body">
                    <div class="ticket-info">
                        <p>Message - {{ $ticket->message }}</p>
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

                    <div class="comment-form">
                        <form action="{{ url('comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
