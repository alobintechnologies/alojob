@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li><a href="#" class="history-back-btn">&larr; Back</a></li>
      <li><a href="{{ route('clients.projects.index', $project->client->id) }}">Projects</a></li>
      <li><a href="{{ route('clients.projects.show', ['clients' => $project->client->id, 'projects' => $project->id]) }}">{{ $project->title }}</a></li>
      <li><a href="{{ route('projects.tickets.index', $project->id) }}">Tickets</a></li>
      <li><a href="{{ route('projects.tickets.show', ['projects' => $project->id, 'tickets' => $ticket->id]) }}">{{ $ticket->id }}</a></li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
      <div class="panel panel-light details-panel-layout ticket-show-panel">
          <div class="panel-heading details-panel-heading">
            <div class="">
              <h3>
                <i class="fa fa-ticket"></i> <span>{{ $ticket->title }} <small><label class="label label-info label-sm">{{ $ticket->status() }}</label></small></span>
                <div class="pull-right">
                  <a href="{{ route('projects.tickets.create', $project->id) }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
                  <a href="#" class="btn btn-sm btn-default"><i class="fa fa-print"></i></a>
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="{{ route('projects.tickets.edit', ['projects' => $project->id, 'tickets' => $ticket->id]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#"><i class="fa fa-mail-forward"></i> Email Assignee</a></li>
                    </ul>
                  </div>
                </div>
              </h3>
              <hr/>
              <p class="heading-info">
                <span>
                  Posted by {{ $ticket->user->email }} on {{ $ticket->created_at->format('M d, Y') }}, {{ $ticket->ticket_category->title }} with <i class="fa {{ $ticket->priority_icon() }}"></i> {{ $ticket->priority() }} priority and assigned to {{ $ticket->assigned_user->email }}
                </span>
              </p>
            </div>
          </div>
          <div class="panel-body details-panel-body">
            <div class="row">
              <div class="col-sm-8">
                <p class="ticket-desc">
                  {!! $ticket->description !!}
                </p>
              </div>
              <div class="col-sm-4">
                <div class="pull-right">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a class="history-back-btn" href="#">&larr; Back</a>
                    </li>
                    <li class="list-group-item">
                      <a class="" href="{{ route('projects.tickets.edit', ['projects' => $project->id, 'tickets' => $ticket->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                    </li>
                    <li class="list-group-item">
                      <form action="{{ route('projects.tickets.destroy', ['projects' => $project->id, 'tickets' => $ticket->id]) }}" method="POST" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-12">
                <hr />
              </div>
              <div class="col-sm-8">
                <h5>Discuss about this ticket</h5>
                <br />
                <div class="ticket-comments">
                  <!-- show the comments already entered in here... -->
                  @include('comments.index', ['resourceId' => $ticket->id, 'resourceType' => 'Ticket', 'comments' => $ticket->comments])
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div> <!-- ./panel-body -->
      </div>  <!-- ./panel -->
  </div> <!-- ./col-sm-12 -->
</div> <!-- ./row -->
<div id="preview-template" style="display: none;">

    <div class="dz-preview dz-file-preview">
      <div class="dz-image"><img data-dz-thumbnail /></div>

      <div class="dz-details">
        <div class="dz-size"><span data-dz-size></span></div>
        <div class="dz-filename"><span data-dz-name></span></div>
      </div>
      <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
      <div class="dz-error-message"><span data-dz-errormessage></span></div>

      <div class="dz-success-mark">
        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
          <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
          <title>Check</title>
          <desc>Created with Sketch.</desc>
          <defs></defs>
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
              <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
          </g>
        </svg>
      </div>
      <div class="dz-error-mark">
        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
            <title>error</title>
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                    <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                </g>
            </g>
        </svg>
      </div>
    </div>
  </div>
@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var commentController = new CommentController({
        'ticketId': '{{ $ticket->id }}',
        'fileUploadUrl' : '{{ route('attachments.store') }}?resourceType=Ticket&resourceId={{ $ticket->id }}'
      });
    });
  </script>
@endsection
