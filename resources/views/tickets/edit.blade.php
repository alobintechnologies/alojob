@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li>Back to: <a href="{{ url('tickets') }}">Tickets</a> / {{ $ticket->id }}</li>
    </ol>
</div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
          <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="form">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="panel panel-default details-panel-layout">
                  <div class="panel-heading details-panel-heading">
                    <div class="">
                      <h3>
                        <i class="fa fa-ticket"></i> <span>Ticket #{{ $ticket->id }}</span>
                        <small class="pull-right">
                          <select class="form-control input-sm" name="ticket_status" id="ticket_status-field">
                            <option value="0">Open</option>
                            <option value="1">On Hold</option>
                            <option value="2">Invalid</option>
                            <option value="3">Fixed</option>
                            <option value="4">Closed</option>
                          </select>
                        </small>
                      </h3>
                      <hr/>
                    </div>
                    @include('error')
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group @if($errors->has('title')) has-error @endif">
                          <label for="title-field">Title*</label>
                          <input type="text" id="title-field" name="title" class="form-control" value="{{ old("title", $ticket->title) }}"/>
                        </div>
                        <div class="form-group @if($errors->has('client_id')) has-error @endif">
                          <label for="client_id-field">Client</label>
                          <div class="input-group">
                            <input type="hidden" name="client_id" value="" />
                            <input type="text" id="client_id-field" name="client_name" class="form-control" value=""/>
                            <span class="input-group-btn">
                              <a href="{{ route('clients.create') }}" class="btn btn-warning">+ New</a>
                            </span>
                          </div>
                        </div>
                        <div class="form-group @if($errors->has('project_id')) has-error @endif">
                          <label for="project_id-field">Project</label>
                          <div class="input-group">
                          <input type="hidden" name="project_id" value="" />
                          <input type="text" id="project_id-field" name="project_name" class="form-control" value=""/>
                            <span class="input-group-btn">
                              {{--<button type="button" id="project-add-btn" class="btn btn-warning">+ New</button>--}}
                              <a href="{{ route('projects.create') }}" class="btn btn-warning">+ New</a>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <br />
                        <div class="project-details panel-details">
                          <table class="table table-striped table-bordered">
                            <tr>
                              <td>
                                <label for="ticket_number">Ticket Number</label>
                              </td>
                              <td>
                                #{{ $ticket->id }}
                              </td>
                            </tr>
                            <tr>
                              <td><label for="ticket_category_id-field">Category</label></td>
                              <td>
                                <div class="form-group @if($errors->has('ticket_category_id')) has-error @endif">
                                   <select class="form-control input-sm" name="ticket_category_id">
                                     @foreach($ticket_categories as $ticket_category)
                                       <option value="{{ $ticket_category->id }}" @if($ticket->ticket_category->id == $ticket_category->id) selected="selected" @endif>{{ $ticket_category->title }}</option>
                                     @endforeach
                                   </select>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label for="assigned_user_id">Assigned To</label>
                              </td>
                              <td>
                                <div class="form-group">
                                   <select class="form-control input-sm" name="assigned_user_id" id="assigned_user_id-field">
                                     @foreach($assignees as $assignee)
                                       <option value="{{ $assignee->user->id }}" @if($ticket->assigned_user->id == $assignee->user->id) selected="selected" @endif>{{ $assignee->user->email }}</option>
                                     @endforeach
                                   </select>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label for="created_at-field">Created</label></td>
                              <td>
                                {{ $ticket->created_at->diffForHumans() }}
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body details-panel-body">
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                       <textarea name="description" id="description-field" class="form-control">{{ old("description", $ticket->description) }}</textarea>
                    </div>
                    <hr/>
                    <div class="pull-right">
                        <a class="btn btn-link btn-sm" href="{{ route('tickets.index') }}"><i class="fa fa-backward"></i> Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div> <!-- ./panel-body -->
                  <div class="panel-footer">
                      <!-- TODO: Code the attachments and comments in here... -->
                  </div>
              </div>  <!-- ./panel -->
          </form>
      </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row -->
@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var ticketController = new TicketController();
      @if($ticket->client)
        $("#client_id-field").val("{{ $ticket->client->name() }}");
        $("input[name='client_id']").val("{{ $ticket->client->id }}");
      @endif
      @if($ticket->project)
        $("#project_id-field").val("{{ $ticket->project->title }}");
        $("input[name='project_id']").val("{{ $ticket->project->id }}");
      @endif
      $("#ticket_status-field").val("{{ $ticket->ticket_status }}");
    });
  </script>
@endsection
