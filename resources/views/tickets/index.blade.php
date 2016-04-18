@extends('layout')
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h2>
                      <i class="fa fa-ticket"></i> Tickets
                      <a class="btn btn-success pull-right" href="{{ route('tickets.create') }}"><i class="fa fa-plus"></i> Create</a>
                  </h2>
                </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-sm-12">
                          @if($tickets->count())
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="input-group">
                                    <input type="text" name="query" value="" placeholder="Search..." class="form-control" />
                                    <span class="input-group-btn"><button type="submit" class="btn btn-default" name="button">Go</button></span>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="input-group">
                                    <span class="input-group-addon">Sort By</span>
                                    <select class="form-control" name="">
                                      <option value="title">Title</option>
                                      <option value="created_on">Created On</option>
                                      <option value="category">Category</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <hr />
                              <div class="hidden-xs">
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
                              </div>
                              @foreach($tickets as $ticket)
                                <a href="{{ url('tickets/'.$ticket->id) }}" class="ticket link-row">
                                  <div class="row">
                                    <div class="col-sm-6 col-lg-7">
                                      <small class="pull-right"><label class="label label-info">{{ $ticket->status() }}</label></small>
                                      <span><i class="fa {{ $ticket->priority_icon() }}"></i> {{ str_limit($ticket->title, 100) }}</span>
                                    </div>
                                    <div class="col-sm-3 col-lg-2">
                                      {{ str_limit($ticket->ticket_category->title, 15) }}
                                    </div>
                                    <div class="col-sm-1 col-lg-1">
                                      <span title="{{ $ticket->assigned_user->email }}" class="hidden-xs"><i class="fa fa-user fa-2x"></i></span>
                                      <span class="visible-xs"><i class="fa fa-user"></i> {{ $ticket->assigned_user->email }}</span>
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
