@extends('layouts.app')

@section('subject', $ticket->subject)

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    #{{ $ticket->id }} - {{ $ticket->subject }}
                </div>
                <div class="card-body">
                    <div class="ticket-info">
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
