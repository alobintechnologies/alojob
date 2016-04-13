@extends('layout')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Tickets / Edit #{{$ticket->id}}</h1>
    </div>
@endsection

@section('content')
  @include('error')

  <div class="row">
      <div class="col-md-12">
          <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group @if($errors->has('title')) has-error @endif">
                  <label for="title-field">Title</label>
                  <input type="text" id="title-field" name="title" class="form-control" value="{{ $ticket->title }}"/>
                  @if($errors->has("title"))
                    <span class="help-block">{{ $errors->first("title") }}</span>
                  @endif
              </div>
              <div class="form-group @if($errors->has('description')) has-error @endif">
                 <label for="description-field">Body</label>
                 <textarea class="form-control" id="description-field" rows="3" name="description">{{ $ticket->description }}</textarea>
                 @if($errors->has("description"))
                  <span class="help-block">{{ $errors->first("description") }}</span>
                 @endif
              </div>
              <div class="well well-sm">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a class="btn btn-link pull-right" href="{{ route('tickets.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
              </div>
          </form>
      </div>
  </div>
@endsection
