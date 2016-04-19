@foreach($tickets as $ticket)
  <a href="{{ route('tickets.show', $ticket->id) }}" class="link-row">
    <div class="row">
      <div class="col-sm-5">
        <h5>{{ $ticket->title }}</h5>
      </div>
      <div class="col-sm-2">
        <h5><small>{{ $ticket->created_at->format('M d Y') }}</small></h5>
      </div>
      <div class="col-sm-2">
        <p>{{ $ticket->ticket_category->title }}</p>
      </div>
      <div class="col-sm-2">
        <p>{{ $ticket->assigned_user->email }}</p>
      </div>
      <div class="col-sm-1">
        <p class="pull-right">
          <label class="label label-default">{{ $ticket->status() }}</label>
        </p>
      </div>
    </div>
  </a>
@endforeach
