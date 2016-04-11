@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="header">
          <h5>
            <a href="{{ url('projects') }}">&raquo; Projects</a> / {{ $project->title }}
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="{{ route('projects.edit', $project->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="fa fa-book"></i> New Quote</a></li>
                <li><a href="#"><i class="fa fa-tasks"></i> New Job</a></li>
                <li><a href="#"><i class="fa fa-file"></i> New Invoice</a></li>
              </ul>
            </div>
            <div class="clearfix">
              &nbsp;
            </div>
          </h5>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="">
              <h3>
                <i class="fa fa-gavel"></i> <span>Project #{{ $project->id }}</span>
                <small class="pull-right"><label class="label label-info">Draft</label></small>
              </h3>
              <hr/>
            </div>
            <div class="row">
              <div class="col-md-6">
                <h2>{{ $project->title }}</h2>
                <p>{{ $project->description }}</p>
              </div>
              <div class="col-md-6">
                <br />
                <div class="project-details panel-details">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td>Project Type</td>
                      <td>{{ $project->project_type }}</td>
                    </tr>
                    <tr>
                      <td>Started On</td>
                      <td>{{ $project->project_type }}</td>
                    </tr>
                    <tr>
                      <td>Ends On</td>
                      <td>{{ $project->project_type }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">

          </div>
        </div>
    </div>
</div>
@endsection
