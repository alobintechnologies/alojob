@extends('layout')
@section('content')

    <div class="row">
        <div class="col-sm-12">
          <form action="{{ route('tickets.store') }}" method="POST" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="panel panel-default details-panel-layout">
                  <div class="panel-heading details-panel-heading">
                    <div class="">
                      <h3>
                        <i class="fa fa-ticket"></i> <span>Ticket #new</span>
                        <small class="pull-right"><label class="label label-info">Open</label></small>
                      </h3>
                      <hr/>
                    </div>
                    @include('error')
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group @if($errors->has('title')) has-error @endif">
                          <label for="title-field">Title*</label>
                          <input type="text" id="title-field" name="title" class="form-control" value="{{ old("title") }}"/>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <br />
                        <div class="project-details panel-details">
                          <table class="table table-striped table-bordered">
                            <tr>
                              <td>
                                <label for="ticket_number">Ticket Number</label>
                              </td>
                              <td>
                                #new
                              </td>
                            </tr>
                            <tr>
                              <td><label for="ticket_category_id-field">Category</label></td>
                              <td>
                                <div class="form-group @if($errors->has('ticket_category_id')) has-error @endif">
                                   <select class="form-control input-sm" name="ticket_category_id">
                                     @foreach($ticket_categories as $ticket_category)
                                       <option value="{{ $ticket_category->id }}">{{ $ticket_category->title }}</option>
                                     @endforeach
                                   </select>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label for="created_at-field">Created On</label></td>
                              <td>
                                <div class="form-group @if($errors->has('created_at')) has-error @endif">
                                   <input type="text" id="created_at-field" name="created_at" class="form-control input-sm" value="{{ old("created_at") }}"/>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label for="assigned_user_id">Assigned To</label>
                              </td>
                              <td>
                                <div class="form-group">
                                   <select class="form-control input-sm" name="assigned_user_id" id="assigned_user_id-field">
                                     @foreach($assignees as $assignee)
                                       <option value="{{ $assignee->user->id }}">{{ $assignee->user->email }}</option>
                                     @endforeach
                                   </select>
                                </div>
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
                    <div class="form-group @if($errors->has('description')) has-error @endif">
                       <label for="description-field">Description</label>
                       <textarea name="description" id="description-field" class="form-control">{{ old("description") }}</textarea>
                    </div>
                    <hr/>
                    <div class="pull-right">
                        <a class="btn btn-link btn-sm" href="{{ route('tickets.index') }}"><i class="fa fa-backward"></i> Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div> <!-- ./panel-body -->
              </div>  <!-- ./panel -->
          </form>
      </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row -->
@endsection
