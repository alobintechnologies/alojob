@extends('layout')

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-user"></i> Clients / Create</div>
              <div class="panel-body">
                <form action="{{ route('clients.store') }}" method="POST" class="form">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <div class="alert alert-info">
                            <p>
                              <i class="fa fa-info-circle"></i> Fields marked with * are mandatory.
                            </p>
                          </div>
                          @include('error')
                          <h2 class="title">Basic Information</h2>
                          <div class="row">
                              <div class="col-sm-2">
                                <div class="form-group @if($errors->has('title')) has-error @endif">
                                  <label for="title-field">Title</label>
                                  <input type="text" id="title-field" name="title" class="form-control" value="{{ old("title") }}"/>
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="form-group @if($errors->has('first_name')) has-error @endif">
                                   <label for="first_name-field">First Name *</label>
                                   <input type="text" id="first_name-field" name="first_name" class="form-control" value="{{ old("first_name") }}"/>
                                </div>
                              </div>
                              <div class="col-sm-5">
                                <div class="form-group @if($errors->has('last_name')) has-error @endif">
                                   <label for="last_name-field">Last Name</label>
                                   <input type="text" id="last_name-field" name="last_name" class="form-control" value="{{ old("last_name") }}"/>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group @if($errors->has('company_name')) has-error @endif">
                                   <label for="company_name-field">Company Name *</label>
                                   <input type="text" id="company_name-field" name="company_name" class="form-control" value="{{ old("company_name") }}"/>
                                </div>
                              </div>
                          </div>
                          <hr>
                          <h2 class="title">Contact Information</h2>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group @if($errors->has('primary_email')) has-error @endif">
                                 <label for="primary_email-field">Primary Email *</label>
                                 <input type="email" id="primary_email-field" name="primary_email" class="form-control" value="{{ old("primary_email") }}"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @if($errors->has('primary_mobile')) has-error @endif">
                                 <label for="primary_mobile-field">Primary Mobile</label>
                                 <input type="text" id="primary_mobile-field" name="primary_mobile" class="form-control" value="{{ old("primary_mobile") }}"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @if($errors->has('secondary_email')) has-error @endif">
                                 <label for="secondary_email-field">Secondary Email</label>
                                 <input type="email" id="secondary_email-field" name="secondary_email" class="form-control" value="{{ old("secondary_email") }}"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group @if($errors->has('secondary_mobile')) has-error @endif">
                                 <label for="secondary_mobile-field">Secondary Mobile</label>
                                 <input type="text" id="secondary_mobile-field" name="secondary_mobile" class="form-control" value="{{ old("secondary_mobile") }}"/>
                              </div>
                            </div>
                          </div>

                          <div class="well well-sm">
                              <button type="submit" class="btn btn-primary">Create</button>
                              <a class="btn btn-link pull-right" href="{{ route('clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                          </div>
                      </div>
                  </div>
              </form>
          </div> <!-- ./panel-body -->
      </div>  <!-- ./panel -->
    </div> <!-- ./col-md-12 -->
  </div> <!-- ./row -->
@endsection
