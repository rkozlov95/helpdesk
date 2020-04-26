@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')

  @if ($errors->any())
    <ul class="list-group mb-2">
      @foreach ($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  @auth
  <div class="card">
    <div class="card-header">
      Open new ticket
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" action="{{ route('tickets.store') }}">
		@csrf
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" name="subject">
        </div>
        <div class="form-group">
          <label>Message</label>
          <textarea class="form-control" rows="3" name="message"></textarea>
        </div>
        <div class="form-group">
          <label>Attachment</label>
          <input type="file" class="form-control-file" name="file">
        </div>
		<button type="submit" class="btn btn-primary">Create</button>
  	  </form>
    </div>
  </div>
  @endauth
@endsection
