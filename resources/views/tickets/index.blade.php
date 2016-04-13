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
                              <div class="row">
                                <div class="col-sm-5">
                                  Title
                                </div>
                                <div class="col-sm-4">
                                  Type
                                </div>
                                <div class="col-sm-3">
                                  Created On
                                </div>
                              </div>
                              <hr />
                              @foreach($tickets as $ticket)
                                <a href="{{ url('tickets/'.$ticket->id) }}" class="ticket link-row">
                                  <div class="row">
                                    <div class="col-sm-1">
                                      <i class="fa fa-2x fa-ticket"></i>
                                    </div>
                                    <div class="col-sm-4">
                                      {{ $ticket->title }}
                                    </div>
                                    <div class="col-sm-4">
                                      {{ $ticket->ticket_category->title }}
                                    </div>
                                    <div class="col-sm-3">
                                      {{ $ticket->created_at->diffForHumans() }}
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
