@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>
            <div class="panel-body">
              <h1>This is the page for {{ $currentAccount->subdomain }}</h1>

              <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                      Code recent tickets bar column chart in here...
                    </p>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                      Code recent projects bar column chart in here...
                    </p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
