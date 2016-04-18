@foreach($tickets as $ticket)
  <a href="{{ route('tickets.show', $ticket->id) }}" class="link-row">
    <div class="row">
      <div class="col-sm-4">
        <h4>{{ $ticket->title }}</h4>
        <label class="label label-default">{{ $ticket->status() }}</label>
      </div>
      <div class="col-sm-2">
        <h5>Created</h5>
        {{ $ticket->created_at->diffForHumans() }}
      </div>
      <div class="col-sm-3">
        <h5>Type</h5>
        {{ $ticket->ticket_category->title }}
      </div>
      <div class="col-sm-3">
        <div class="pull-right">
          <h5>Assigned</h5>
          {{ $ticket->assigned_user->email }}
        </div>
      </div>
    </div>
  </a>
@endforeach
