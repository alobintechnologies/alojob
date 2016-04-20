@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li><a href="#" class="history-back-btn">&larr; Back</a></li>
      @if($project)
        <li><a href="{{ route('projects.index') }}">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a></li>
        <li><a href="{{ route('tickets.index') }}?project_number={{ $project->id }}">Tickets</a></li>
      @else
        <li><a href="{{ route('tickets.index') }}">Tickets</a></li>
      @endif
      <li>new</li>
    </ol>
</div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
          <form action="{{ route('tickets.store') }}" method="POST" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @include('error')
              <div class="panel panel-light panel-default details-panel-layout">
                  <div class="panel-heading details-panel-heading">
                    <h3>
                      <div class="row">
                        <div class="col-sm-10">
                          <div class="form-group details-panel-form-group @if($errors->has('title')) has-error @endif">
                            <textarea name="title" id="title-field" name="title" autofocus="autofocus" data-autoresize="true" rows="1" class="form-control details-panel-title-field" placeholder="Type ticket subject here...">{{ old("title") }}</textarea>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <small class="pull-right"><label class="label label-info">Open</label></small>
                        </div>
                      </div>
                    </h3>
                  </div>
                  <div class="panel-body details-panel-body">
                    <div class="form-group editor-borderless editor-statusbarless @if($errors->has('description')) has-error @endif">
                       <textarea name="description" id="description-field" class="form-control">{{ old("description") }}</textarea>
                    </div>
                    <p>
                      Attach files by drag and drop or <input type="file" multiple="multiple" class="file-chooser"><button type="button" class="btn-link file-chooser-text">select from your computer</button>
                    </p>
                    <hr />
                    <div class="row">
                      <div class="col-sm-6">
                        {{--<div class="form-group @if($errors->has('client_id')) has-error @endif">
                          <label for="client_id-field">Client</label>
                          <div class="input-group">
                            <input type="hidden" name="client_id" value="" />
                            <input type="text" id="client_id-field" name="client_name" class="form-control" value=""/>
                            <span class="input-group-btn">
                              <a href="{{ route('clients.create') }}" class="btn btn-warning">+ New</a>
                            </span>
                          </div>
                        </div>--}}
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
                        <div class="form-group">
                          <label for="priority_id-field">Priority</label>
                          <select class="form-control" name="priority_id" id="priority_id-field">
                            <option value="0">Low</option>
                            <option value="1">Medium</option>
                            <option value="2">High</option>
                            <option value="3">Critical</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <br />
                        <div class="project-details panel-details">
                          <ul class="list-group">
                            <li class="list-group-item">
                              <div class="row">
                                <div class="col-xs-6">
                                  <label for="ticket_number">Ticket Number</label>
                                </div>
                                <div class="col-xs-6">
                                 <span>#new</span>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <div class="col-xs-6">
                                  <span for="ticket_category_id-field">Categorise your ticket</span>
                                </div>
                                <div class="col-xs-6">
                                  <div class="form-group @if($errors->has('ticket_category_id')) has-error @endif">
                                     <select class="form-control input-sm" name="ticket_category_id">
                                       @foreach($ticket_categories as $ticket_category)
                                         <option value="{{ $ticket_category->id }}">{{ $ticket_category->title }}</option>
                                       @endforeach
                                     </select>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <div class="col-xs-6">
                                  <span for="assigned_user_id">To whom you wish to assign?</span>
                                </div>
                                <div class="col-xs-6">
                                  <div class="form-group">
                                     <select class="form-control input-sm" name="assigned_user_id" id="assigned_user_id-field">
                                       @foreach($assignees as $assignee)
                                         <option value="{{ $assignee->user->id }}">{{ $assignee->user->email }}</option>
                                       @endforeach
                                     </select>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Post ticket</button> or <a href="#" class="btn btn-default">Cancel</a>
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
