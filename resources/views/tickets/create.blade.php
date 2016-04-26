@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li><a href="#" class="history-back-btn">&larr; Back</a></li>
      @if($project)
        <li><a href="{{ route('projects.index') }}">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a></li>
        <li><a href="{{ route('projects.tickets.index', $project->id) }}">Tickets</a></li>
      @else
        <li><a href="{{ route('projects.tickets.index', $project->id) }}">Tickets</a></li>
      @endif
      <li>new</li>
    </ol>
</div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
          <form action="{{ route('projects.tickets.store', $project->id) }}" method="POST" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @include('error')
              <div class="panel panel-light panel-default details-panel-layout">
                  <div class="panel-heading details-panel-heading">
                    <h3>
                      <div class="row">
                        <div class="col-sm-10">
                          <div class="form-group details-panel-form-group @if($errors->has('title')) has-error @endif">
                            <textarea tabindex="0" name="title" id="title-field" name="title" autofocus="autofocus" data-autoresize="true" rows="1" class="form-control details-panel-title-field" placeholder="Type ticket subject here...">{{ old("title") }}</textarea>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <small class="pull-right"><label class="label label-info">Open</label></small>
                        </div>
                      </div>
                    </h3>
                  </div>
                  <div class="panel-body details-panel-body">
                    <div class="form-group editor-borderless editor-statusbarless @if($errors->has('description')) has-error @endif" id="description-field-group">
                       <textarea name="description" id="description-field" class="form-control" tabindex="1">{{ old("description") }}</textarea>
                    </div>
                    <hr />
                    <p>
                       <span>Set category as</span>
                       <select class="input-sm inline-select" name="ticket_category_id">
                         @foreach($ticket_categories as $ticket_category)
                           <option value="{{ $ticket_category->id }}">{{ $ticket_category->title }}</option>
                         @endforeach
                       </select>
                       <span>with</span>
                       <select class="input-sm inline-select" name="priority_id" id="priority_id-field">
                         <option value="0">Low</option>
                         <option value="1">Medium</option>
                         <option value="2">High</option>
                         <option value="3">Critical</option>
                       </select>
                       <span>priority and assigned to</span>
                       <select class="input-sm inline-select" name="assigned_user_id" id="assigned_user_id-field">
                         @foreach($assignees as $assignee)
                           <option value="{{ $assignee->user->id }}">{{ $assignee->user->email }}</option>
                         @endforeach
                       </select>
                    </p>

                    <p class="well well-sm well-light">
                      <i class="fa fa-paperclip"></i> To attach files <input type="file" multiple="multiple" class="file-chooser"><button type="button" class="btn-link file-chooser-text">select from your computer</button>
                    </p>
                    {{--<hr />
                    <div class="">
                      <div class="form-group @if($errors->has('project_id')) has-error @endif">
                        <label for="project_id-field">Project</label>
                        <div class="input-group">
                          <input type="hidden" name="project_id" value="" />
                          <input type="text" id="project_id-field" name="project_name" class="form-control" value="" placeholder="Type project title here..."/>
                          <span class="input-group-btn">
                            <a href="{{ route('projects.create') }}" class="btn btn-warning">+ New</a>
                          </span>
                        </div>
                      </div>
                    </div>
                    <hr />--}}
                    <button type="submit" class="btn btn-primary">Post ticket</button> or <a href="{{ route('projects.tickets.index', $project->id) }}" class="btn btn-default">Cancel</a>
                  </div> <!-- ./panel-body -->
              </div>  <!-- ./panel -->
          </form>
      </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row -->
@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var ticketController = new TicketController();
      @if($project)
        ticketController.project("{{ $project->id }}", "{{ $project->title }}");
      @endif
    });
  </script>
@endsection
