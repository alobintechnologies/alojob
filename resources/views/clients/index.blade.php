@extends('layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h2>
                  <i class="fa fa-user"></i> Clients
                  <a class="btn btn-success pull-right" href="{{ route('clients.create') }}"><i class="fa fa-plus"></i> Create</a>
              </h2>
            </div>
            <div class="panel-body">
              <div class="row">
                  <div class="col-md-12">
                      @if($clients->count())
                          <div class="row">
                            <div class="col-md-6">
                              <div class="input-group">
                                <input type="text" name="query" value="" placeholder="Search..." class="form-control" />
                                <span class="input-group-btn"><button type="submit" class="btn btn-default" name="button">Go</button></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group">
                                <span class="input-group-addon">Sort</span>
                                <select class="form-control" name="">
                                  <option value="name">Name</option>
                                  <option value="company">Company</option>
                                  <option value="email">Email</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <hr />
                          <div class="row">
                            <div class="col-md-4">
                              Name
                            </div>
                            <div class="col-md-4">
                              Company Name
                            </div>
                            <div class="col-md-4">
                              Email
                            </div>
                          </div>
                          <hr />
                          @foreach($clients as $client)
                            <a href="{{ url('clients/'.$client->id) }}" class="client link-row">
                              <div class="row">
                                <div class="col-sm-1">
                                  <i class="fa fa-2x fa-user"></i>
                                </div>
                                <div class="col-sm-3">
                                  {{ $client->name() }}
                                </div>
                                <div class="col-sm-4">
                                  {{ $client->company_name }}
                                </div>
                                <div class="col-sm-4">
                                  {{ $client->primary_email }}
                                </div>
                                {{--<div class="col-md-3">
                                  <a class="btn btn-xs btn-primary" href="{{ route('clients.show', $client->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                  <a class="btn btn-xs btn-warning" href="{{ route('clients.edit', $client->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                  <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                  </form>
                                </div>--}}
                              </div>
                            </a>
                          @endforeach
                          {!! $clients->render() !!}
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
