@extends('layout')

@section('header')
<div class="header">
  <ol class="breadcrumb">
    <li><a href="#" class="history-back-btn">&larr; Back</a></li>
    <li><a href="{{ route('clients.projects.index', $project->client->id) }}">Projects</a></li>
    <li><a href="{{ route('clients.projects.show', ['clients' => $project->client->id, 'projects' => $project->id]) }}">{{ $project->title }}</a></li>
    <li><a href="{{ route('projects.tickets.index', $project->id) }}">Tickets</a></li>
  </ol>
</div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-light details-panel-layout">
                <div class="panel-heading details-panel-heading">
                  <h3>
                    <i class="fa fa-ticket"></i> Tickets
                    <a class="btn btn-success pull-right" href="{{ route('projects.tickets.create', $project->id) }}"><i class="fa fa-plus"></i> Create</a>
                  </h3>
                  <p class="heading-info">
                    <span>Sort tickets by </span>
                    <select class="input-sm inline-select form-control" name="sort">
                      <option value="latest">latest</option>
                      <option value="oldest">oldest</option>
                    </select>
                    <span>and filter by </span>
                    <select class="input-sm inline-select form-control" name="sort">
                      <option value="0">Open</option>
                      <option value="1">On Hold</option>
                      <option value="2">Invalid</option>
                      <option value="3">Fixed</option>
                      <option value="4">Closed</option>
                    </select>
                    <input type="text" name="query" value="" placeholder="title or type" class="form-control input-sm inline-input" />
                  </p>
                </div>

                <div class="panel-body details-panel-body">
                  <div class="row">
                      <div class="col-sm-12">
                          @if($tickets->count())
                              {{--<div class="hidden-xs">
                                <div class="row">
                                  <div class="col-sm-6 col-lg-7">
                                    Title
                                  </div>
                                  <div class="col-sm-3 col-lg-2">
                                    Type
                                  </div>
                                  <div class="col-sm-1 col-lg-1">
                                    Assigned
                                  </div>
                                  <div class="col-sm-2 col-lg-2">
                                    Created
                                  </div>
                                </div>
                                <hr />
                              </div>--}}
                              @foreach($tickets as $ticket)
                                <a href="{{ route('projects.tickets.show', ['projects' => $project->id, 'tickets' => $ticket->id]) }}" class="ticket link-row">
                                  <div class="row">
                                    <div class="col-sm-6 col-lg-7">
                                      <small class="pull-right"><label class="label label-info">{{ $ticket->status() }}</label></small>
                                      <span class="ticket-title"><i class="fa {{ $ticket->priority_icon() }}"></i> {{ str_limit($ticket->title, 100) }} - </span>
                                      <span class="ticket-desc">{{ str_limit(strip_tags($ticket->description), 150) }}</span>
                                    </div>
                                    <div class="col-sm-3 col-lg-2">
                                      <span class="ticket-category">{{ str_limit($ticket->ticket_category->title, 15) }}</span>
                                    </div>
                                    <div class="col-sm-1 col-lg-1">
                                      <span title="{{ $ticket->assigned_user->email }}" class="hidden-xs ticket-assigned-to"><i class="fa fa-user fa-2x"></i></span>
                                      <span class="visible-xs ticket-assigned-to"><i class="fa fa-user"></i> {{ $ticket->assigned_user->email }}</span>
                                    </div>
                                    <div class="col-sm-2 col-lg-2">
                                      <span class="visible-xs">Created: </span>{{ $ticket->created_at->diffForHumans() }}
                                    </div>
                                  </div>
                                </a>
                              @endforeach
                              {!! $tickets->render() !!}
                          @else
                              <h3 class="text-center alert alert-info">Empty!</h3>
                          @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
