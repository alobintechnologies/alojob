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
                                     <option value="website">website</option>
                                     <option value="webapp">webapp</option>
                                     <option value="mobile">mobile</option>
                                     <option value="other">other</option>
                                   </select>
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
