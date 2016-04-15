@extends('layout')

@section('content')

  <div class="row">
      <div class="col-sm-12">
          <div class="panel panel-default">
              <div class="panel-heading"><a href="{{ url('projects') }}"><i class="fa fa-briefcase"></i> Projects</a> / Create</div>
              <div class="panel-body">
                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                      <div class="col-sm-8 col-sm-offset-2">
                          <div class="alert alert-info">
                            <p>
                              <i class="fa fa-info-circle"></i> Fields marked with * are mandatory.
                            </p>
                          </div>
                          @include('error')
                          <h2 class="title">Basic Information</h2>
                          <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                  <label for="title-field">Title*</label>
                                  <input type="text" id="title-field" name="title" class="form-control" value="{{ $project->title }}"/>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group @if($errors->has('project_type')) has-error @endif">
                                   <label for="project_type-field">Project Type</label>
                                   <select class="form-control" name="project_type">
                                     <option value="general">General</option>
                                     <option value="website">Website</option>
                                     <option value="webapp">Webapp</option>
                                     <option value="mobile">Mobile</option>
                                     <option value="other">Other</option>
                                   </select>
                                </div>
                              </div>
                              <div class="col-sm-12">
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
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group @if($errors->has('description')) has-error @endif">
                                   <label for="description-field">Description</label>
                                   <input type="text" id="description-field" name="description" class="form-control" value="{{ $project->description }}"/>
                                </div>
                              </div>                              
                          </div>
                          <div class="well well-sm">
                              <button type="submit" class="btn btn-primary">Save</button>
                              <a class="btn btn-link pull-right" href="{{ route('projects.index') }}"><i class="fa fa-backward"></i> Back</a>
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
      @if($project->client)
        projectController.client("{{ $project->client->id }}", "{{ $project->client->title }}");
      @endif
    });
  </script>
@endsection
