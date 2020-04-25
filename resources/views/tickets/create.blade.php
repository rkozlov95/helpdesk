@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')
  <div class="card">
    <div class="card-header">
      Open new ticket
    </div>
    <div class="card-body">
	  @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
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
@endsection
