@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Clients / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('clients.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('title')) has-error @endif">
                       <label for="title-field">Title</label>
                    <input type="text" id="title-field" name="title" class="form-control" value="{{ old("title") }}"/>
                       @if($errors->has("title"))
                        <span class="help-block">{{ $errors->first("title") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('first_name')) has-error @endif">
                       <label for="first_name-field">First_name</label>
                    <input type="text" id="first_name-field" name="first_name" class="form-control" value="{{ old("first_name") }}"/>
                       @if($errors->has("first_name"))
                        <span class="help-block">{{ $errors->first("first_name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('last_name')) has-error @endif">
                       <label for="last_name-field">Last_name</label>
                    <input type="text" id="last_name-field" name="last_name" class="form-control" value="{{ old("last_name") }}"/>
                       @if($errors->has("last_name"))
                        <span class="help-block">{{ $errors->first("last_name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('company_name')) has-error @endif">
                       <label for="company_name-field">Company_name</label>
                    <input type="text" id="company_name-field" name="company_name" class="form-control" value="{{ old("company_name") }}"/>
                       @if($errors->has("company_name"))
                        <span class="help-block">{{ $errors->first("company_name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('primary_mobile')) has-error @endif">
                       <label for="primary_mobile-field">Primary_mobile</label>
                    <input type="text" id="primary_mobile-field" name="primary_mobile" class="form-control" value="{{ old("primary_mobile") }}"/>
                       @if($errors->has("primary_mobile"))
                        <span class="help-block">{{ $errors->first("primary_mobile") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('secondary_mobile')) has-error @endif">
                       <label for="secondary_mobile-field">Secondary_mobile</label>
                    <input type="text" id="secondary_mobile-field" name="secondary_mobile" class="form-control" value="{{ old("secondary_mobile") }}"/>
                       @if($errors->has("secondary_mobile"))
                        <span class="help-block">{{ $errors->first("secondary_mobile") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('primary_email')) has-error @endif">
                       <label for="primary_email-field">Primary_email</label>
                    <input type="text" id="primary_email-field" name="primary_email" class="form-control" value="{{ old("primary_email") }}"/>
                       @if($errors->has("primary_email"))
                        <span class="help-block">{{ $errors->first("primary_email") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('secondary_email')) has-error @endif">
                       <label for="secondary_email-field">Secondary_email</label>
                    <input type="text" id="secondary_email-field" name="secondary_email" class="form-control" value="{{ old("secondary_email") }}"/>
                       @if($errors->has("secondary_email"))
                        <span class="help-block">{{ $errors->first("secondary_email") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('clients.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
