@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li><a href="#" class="history-back-btn">&larr; Back</a></li>
      <li><a href="{{ route('clients.show', $client->id) }}">{{ $client->name() }}</a></li>
      <li><a href="{{ route('clients.projects.index', $client->id) }}">Projects</a></li>
      <li><a href="{{ route('clients.projects.show', ['clients' => $client->id, 'projects' => $project->id]) }}">{{ $project->title }}</a></li>
      <li>Edit</li>
    </ol>
</div>
@endsection

@section('content')

  <div class="row">
      <div class="col-sm-12">
          <div class="panel panel-default">
              <div class="panel-body">
                <form action="{{ route('clients.projects.update', ['clients' => $client->id, 'projects' => $project->id]) }}" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                      <div class="col-sm-8 col-sm-offset-2">
                          <div class="">
                            <p>
                              <i class="fa fa-info-circle"></i> Fields marked with * are mandatory.
                            </p>
                          </div>
                          @include('error')
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                  <label for="title-field">Title*</label>
                                  <input type="text" id="title-field" name="title" class="form-control input-lg" value="{{ $project->title }}"/>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group @if($errors->has('project_type')) has-error @endif">
                                   <label for="project_type-field">Project Type</label>
                                   <select class="form-control input-lg" name="project_type" id="project_type-field">
                                     <option value="general">General</option>
                                     <option value="website">Website</option>
                                     <option value="webapp">Webapp</option>
                                     <option value="mobile">Mobile</option>
                                     <option value="other">Other</option>
                                   </select>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              {{--<div class="col-sm-12">
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
                              </div>--}}
                              <div class="col-sm-12">
                                <div class="form-group @if($errors->has('description')) has-error @endif">
                                   <label for="description-field">Description</label>
                                   <input type="text" id="description-field" name="description" class="form-control input-lg" value="{{ $project->description }}"/>
                                </div>
                              </div>
                          </div>
                          <div class="well well-sm">
                              <button type="submit" class="btn btn-primary">Save</button>
                              <a class="btn btn-link pull-right" href="{{ route('clients.projects.index', $client->id) }}"><i class="fa fa-backward"></i> Back</a>
                          </div>
                      </div>
                  </div>
              </form>
          </div> <!-- ./panel-body -->
      </div>  <!-- ./panel -->
    </div> <!-- ./col-sm-12 -->
  </div> <!-- ./row -->

@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var projectController = new ProjectController();
      $("#project_type-field").val("{{ $project->project_type }}");
      @if($project->client)
        projectController.client("{{ $project->client->id }}", "{{ $project->client->name() }}");
      @endif
    });
  </script>
@endsection
