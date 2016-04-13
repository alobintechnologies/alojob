@extends('layout')

@section('content')

    <div class="row">
        <div class="col-sm-12">
          <div class="header">
            <h5>
              <a href="{{ url('tickets') }}">&raquo; Tickets</a> / {{ $ticket->title }}
              <div class="pull-right">
                <a href="#" class="btn btn-sm btn-default"><i class="fa fa-print"></i></a>
                <div class="btn-group">
                  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('tickets.edit', $ticket->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="fa fa-mail-forward"></i> Email Assignee</a></li>
                  </ul>
                </div>
              </div>
              <div class="clearfix">
                &nbsp;
              </div>
            </h5>
          </div>
          <div class="panel panel-default details-panel-layout">
              <div class="panel-heading details-panel-heading">
                <div class="">
                  <h3>
                    <i class="fa fa-ticket"></i> <span>Ticket #{{ $ticket->id }}</span>
                    <small class="pull-right"><label class="label label-info">{{ $ticket->status() }}</label></small>
                  </h3>
                  <hr/>
                </div>
                @include('error')
                <div class="row">
                  <div class="col-sm-6">
                    <h4>{{ $ticket->title }}</h4>
                    @if($ticket->client != null)
                    <h4>Client: <a href="{{ route('clients.show', $ticket->client->id) }}">{{ $ticket->client->name() }}</a></h4>
                    @endif
                    @if($ticket->project != null)
                    <h4>Project: <a href="{{ route('projects.show', $ticket->project->id) }}">{{ $ticket->project->title }}</a></h4>
                    @endif
                  </div>
                  <div class="col-sm-6">
                    <br />
                    <div class="ticket-details panel-details">
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
                            {{ $ticket->ticket_category->title }}
                          </td>
                        </tr>
                        <tr>
                          <td><label for="created_at-field">Created On</label></td>
                          <td>
                            {{ $ticket->created_at->diffForHumans() }}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label for="assigned_user_id">Assigned To</label>
                          </td>
                          <td>
                            {{ $ticket->assigned_user->email }}
                          </td>
                        </tr>
                        <tr>
                          <td>Ends On</td>
                          <td>05/09/2016</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <p>
                  {!! $ticket->description !!}
                </p>
                <hr/>
                <div class="pull-right">
                    <a class="btn btn-link btn-sm" href="{{ route('tickets.index') }}"><i class="fa fa-backward"></i> Back</a>
                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="btn-group pull-right" role="group" aria-label="...">
                            <a class="btn btn-warning btn-group" role="group" href="{{ route('tickets.edit', $ticket->id) }}"><i class="fa fa-edit"></i> Edit</a>
                            <button type="submit" class="btn btn-danger">Delete <i class="fa fa-trash"></i></button>
                        </div>
                    </form>
                </div>
              </div> <!-- ./panel-body -->
          </div>  <!-- ./panel -->
      </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row -->
@endsection
