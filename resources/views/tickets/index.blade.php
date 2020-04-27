@extends('layouts.app')

@section('content')

<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
  @if(session()->get('warning'))
    <div class="alert alert-danger">
      {{ session()->get('warning') }}
    </div>
  @endif

  @auth
  <table id="table" class="table table-hover">
    <thead>
        <tr>
          <td>Ticket ID</td>
          <td>User E-mail</td>
          <td>Subject</td>
          <td>Message</td>
          <td>Status</td>
          <td>There is a manager</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
		@can('index', $ticket)
        <tr>
            <td><a href="{{ route('tickets.show', $ticket->id) }}">{{$ticket->id}}</a></td>
            <td>{{$ticket->user->email}}</td>
            <td>{{$ticket->subject}}</td>
            <td>{!! Str::limit($ticket->message, 70) !!}</td>
            <td>
				@if ($ticket->status === 'Open')
                	<span class="badge badge-success">{{ $ticket->status }}</span>
                @else
                    <span class="badge badge-danger">{{ $ticket->status }}</span>
                @endif
			</td>
            <td>
                @if ($ticket->manager_id)
                    <span class="badge badge-success">Yes</span>
                @else
                    <span class="badge badge-danger">No</span>
                @endif
            </td>
        </tr>
		@endcan
        @endforeach
    </tbody>
  </table>
  @endauth
<div>
@endsection
