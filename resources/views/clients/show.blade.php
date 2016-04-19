@extends('layout')
@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li><a href="#" class="history-back-btn">&larr; Back</a></li>
      <li><a href="{{ url('clients') }}">Clients</a></li>
    </ol>
</div>
@endsection

@section('content')
  <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default details-panel-layout">
          <div class="panel-heading details-panel-heading">
            <div class="">
              <h3>
                <i class="fa fa-user"></i> <span>{{ $client->name() }} #{{ $client->id }}</span>
                <div class="pull-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('clients.edit', $client->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('quotes.create') }}"><i class="fa fa-book"></i> New Quote</a></li>
                      <li><a href="{{ route('projects.create') }}?client_number={{ $client->id }}"><i class="fa fa-gavel"></i> New Project</a></li>
                      <li><a href="#"><i class="fa fa-file"></i> New Invoice</a></li>
                    </ul>
                  </div>
                </div>
              </h3>
              <hr/>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <span>Quick Add</span>
                  <a href="{{ route('tickets.create') }}" class="btn btn-default btn-sm">
                    <i class="fa fa-ticket"></i> Ticket
                  </a>
                  <a href="{{ route('projects.create') }}?client_number={{ $client->id }}" class="btn btn-default btn-sm">
                    <i class="fa fa-gavel"></i> Project
                  </a>
                  <a href="{{ route('quotes.create') }}" class="btn btn-default btn-sm">
                    <i class="fa fa-file"></i> Quote
                  </a>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="client-details panel-details">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <th>Company Name</th>
                      <td>{{ $client->company_name }}</td>
                    </tr>
                    <tr>
                      <th>Primary Email</th>
                      <td>{{ $client->primary_email }}</td>
                    </tr>
                    <tr>
                      <th>Primary Mobile</th>
                      <td>{{ $client->primary_mobile }}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="col-sm-12">
                <div class="panel">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#ProjectsTab" role="tab" data-toggle="tab">Projects</a></li>
                    <li role="presentation"><a href="#QuotesTab" role="tab" data-toggle="tab">Quotes</a></li>
                    <li role="presentation"><a href="#InvoicesTab" role="tab" data-toggle="tab">Invoices</a></li>
                    <li role="presentation" class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">+ New <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('quotes.create') }}"><i class="fa fa-book"></i> Quote</a></li>
                        <li><a href="{{ route('projects.create') }}?client_number={{ $client->id }}"><i class="fa fa-gavel"></i> Project</a></li>
                        <li><a href="#"><i class="fa fa-file"></i> Invoice</a></li>
                      </ul>
                    </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="ProjectsTab">
                      @include('projects._list', ['projects' => $client->projects])
                    </div>
                    <div role="tabpanel" class="tab-pane" id="QuotesTab"></div>
                    <div role="tabpanel" class="tab-pane" id="InvoicesTab"></div>
                  </div>
                </div> <!-- ./overview-panel -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4>
                      <a href="{{ route('tickets.index') }}"><i class="fa fa-ticket"></i> Tickets</a>
                      <div class="pull-right">
                        <a href="{{ route('tickets.create') }}" class="btn btn-sm btn-success">+ New</a>
                      </div>
                    </h4>
                  </div>
                  <div class="panel-body">
                      @include('tickets._list', ['tickets' => $client->tickets])
                  </div>
              </div> <!-- ./tasks-tickets-panel -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    Discussions
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-sm"><i class="fa fa-comments"></i> New Discussion</a>
                    </div>
                  </h4>
                </div>
                <div class="panel-body">
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-sm-6">
                        <h4>Problem in the hms module</h4>
                        <label class="label label-info">Open</label>
                      </div>
                      <div class="col-sm-2">
                        <h5>Dated On</h5>
                        07/04/2016
                      </div>
                      <div class="col-sm-4">
                        <div class="pull-right">
                          <h5>Created By</h5>
                          Satheesh Kumar
                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-sm-6">
                        <h4>Problem in the hms module</h4>
                        <label class="label label-info">Open</label>
                      </div>
                      <div class="col-sm-2">
                        <h5>Dated On</h5>
                        07/04/2016
                      </div>
                      <div class="col-sm-4">
                        <div class="pull-right">
                          <h5>Created By</h5>
                          Satheesh Kumar
                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-sm-6">
                        <h4>Problem in the hms module</h4>
                        <label class="label label-default">Closed</label>
                      </div>
                      <div class="col-sm-2">
                        <h5>Dated On</h5>
                        07/04/2016
                      </div>
                      <div class="col-sm-4">
                        <div class="pull-right">
                          <h5>Created By</h5>
                          Satheesh Kumar
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div> <!-- ./discussion-panel -->
            </div>
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    Billing History
                    <div class="pull-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          + New <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa fa-tasks"></i> Record Payment</a></li>
                          <li><a href="#"><i class="fa fa-ticket"></i> Record Deposit</a></li>
                        </ul>
                      </div>
                    </div>
                  </h4>
                </div>
                <div class="panel-body">
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-xs-4">
                        <strong>Payment</strong>
                      </div>
                      <div class="col-xs-4">
                        07/04/2016
                      </div>
                      <div class="col-xs-4">
                        <strong>$300.00</strong>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-xs-4">
                        <strong>Payment</strong>
                      </div>
                      <div class="col-xs-4">
                        07/04/2016
                      </div>
                      <div class="col-xs-4">
                        <strong>$300.00</strong>
                      </div>
                    </div>
                  </a>
                </div>
              </div> <!-- ./billing-history-panel -->
            </div>
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    Files
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-sm"><i class="fa fa-upload"></i> Upload</a>
                    </div>
                  </h4>
                </div>
                <div class="panel-body">
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-sm-2">
                        <i class="fa fa-file fa-lg"></i>
                      </div>
                      <div class="col-sm-10">
                        Proposal attachment.pdf
                      </div>
                    </div>
                  </a>
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-sm-2">
                        <i class="fa fa-file fa-lg"></i>
                      </div>
                      <div class="col-sm-10">
                        Proposal attachment.pdf
                      </div>
                    </div>
                  </a>
                </div>
              </div> <!-- ./ files-panel -->
            </div>
        </div><!-- ./details-panel-body -->
        <div class="panel-footer">
          <div class="">
            <span>Note: Deleting this client will remove thier projects, tasks, tickets, discussions, etc.</span>
            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;" class="pull-right" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="btn-group pull-right" role="group" aria-label="">
                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </div>
            </form>
            <div class="clearfix"></div>
          </div>
        </div>
      </div> <!-- ./details-panel-layout -->
    </div> <!-- ./col-sm-12 -->
  </div> <!-- ./row -->

@endsection
