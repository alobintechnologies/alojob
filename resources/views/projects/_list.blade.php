@foreach($projects as $project)
  <a href="{{ route('clients.projects.show', ['clients' => $client->id, 'projects' => $project->id]) }}" class="link-row">
    <div class="row">
      <div class="col-sm-6">
        <h5>{{ $project->title }} - <small>{{ str_limit($project->description, 100) }}</small></h5>
      </div>
      <div class="col-sm-2">
        <h5><small>{{ $project->created_at->format('M d Y') }}</small></h5>
      </div>
      <div class="col-sm-2">
        <p class="link-column">{{ $project->project_type }}</p>
      </div>
      <div class="col-sm-2">
        <div class="pull-right">
          <h5><label class="label label-{{ $project->status_color() }}">{{ $project->project_status() }}</label></h5>
        </div>
      </div>
    </div>
  </a>
@endforeach
