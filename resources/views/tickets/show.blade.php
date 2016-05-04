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
@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var commentController = new CommentController({
        'ticketId': '{{ $ticket->id }}'
      });

      Dropzone.options.commentFormDropzone = {
          dictDefaultMessage: 'To attach files drag & drop or click to select from computer',
          clickable: true,
          previewTemplate: '<div class="dz-preview dz-file-preview">'
                          + '<div class="dz-details">'
                            + '<div class="dz-filename"><span data-dz-name></span></div>'
                            + '<div class="dz-size" data-dz-size></div>'
                            + '<img data-dz-thumbnail />'
                          + '</div>'
                          + '<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>'
                          + '<div class="dz-success-mark"><span>✔</span></div>'
                          + '<div class="dz-error-mark"><span>✘</span></div>'
                          + '<div class="dz-error-message"><span data-dz-errormessage></span></div>'
                        + '</div>'
      }
    });
  </script>
@endsection
