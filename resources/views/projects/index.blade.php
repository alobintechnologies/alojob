@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li><a href="#" class="history-back-btn">&larr; Back</a></li>
      <li><a href="{{ route('clients.show', $client->id) }}">{{ $client->name() }}</a></li>
      <li><a href="{{ route('clients.projects.index', $client->id) }}">Projects</a></li>
    </ol>
</div>
@endsection

@section('content')

  <div class="row">
      <div class="col-sm-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h2>
                    <i class="fa fa-briefcase"></i> Projects
                    <a class="btn btn-success pull-right" href="{{ route('clients.projects.create', $client->id) }}"><i class="fa fa-plus"></i> Create</a>
                </h2>
              </div>
              <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if($projects->count())
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
                                    <option value="company">Description</option>
                                    <option value="type">Type</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <hr />
                            <div class="row">
                              <div class="col-sm-4">
                                Title
                              </div>
                              <div class="col-sm-4">
                                Description
                              </div>
                              <div class="col-sm-4">
                                Type
                              </div>
                            </div>
                            <hr />
                            @foreach($projects as $project)
                              <a href="{{ route('clients.projects.show', ['clients' => $client->id, 'projects' => $project->id]) }}" class="project link-row">
                                <div class="row">
                                  <div class="col-sm-1">
                                    <i class="fa fa-2x fa-user"></i>
                                  </div>
                                  <div class="col-sm-3">
                                    {{ $project->title }}
                                  </div>
                                  <div class="col-sm-4">
                                    {{ $project->description }}
                                  </div>
                                  <div class="col-sm-4">
                                    {{ $project->project_type }}
                                  </div>
                                </div>
                              </a>
                            @endforeach
                            {!! $projects->render() !!}
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
