@foreach($tickets as $ticket)
  <a href="{{ route('tickets.show', $ticket->id) }}?client_number={{ $client->id }}" class="link-row">
    <div class="row">
      <div class="col-sm-4">
        <h5>
          <span><i class="fa {{ $ticket->priority_icon() }}"></i> {{ str_limit($ticket->title, 100) }}</span>
        </h5>
      </div>
      <div class="col-sm-2">
        <h5>
          <small>{{ $ticket->project->title }}</small>
        </h5>
      </div>
      <div class="col-sm-1">
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