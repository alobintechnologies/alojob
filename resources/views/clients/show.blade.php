@extends('layout')
@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li>Back to: <a href="{{ url('clients') }}">Clients</a></li>
    </ol>

</div>
@endsection

@section('content')
  <h1>
    {{ $client->name() }}
    <div class="btn-group pull-right">
      <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="{{ route('clients.edit', $client->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#"><i class="fa fa-book"></i> New Quote</a></li>
        <li><a href="#"><i class="fa fa-tasks"></i> New Job</a></li>
        <li><a href="#"><i class="fa fa-file"></i> New Invoice</a></li>
      </ul>
    </div>
  </h1>
  <hr/>
  <div class="row">
      <div class="col-md-8">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h4>
                  Overview
                  <div class="pull-right">
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        + New <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-book"></i> New Quote</a></li>
                        <li><a href="#"><i class="fa fa-gavel"></i> New Job</a></li>
                        <li><a href="#"><i class="fa fa-file"></i> New Invoice</a></li>
                      </ul>
                    </div>
                  </div>
                </h4>
              </div>
              <div class="panel-body">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#RecentActivityTab" role="tab" data-toggle="tab">Recent Activity</a></li>
                  <li><a href="#QuotesTab" role="tab" data-toggle="tab">Quotes</a></li>
                  <li><a href="#JobsTab" role="tab" data-toggle="tab">Jobs</a></li>
                  <li><a href="#InvoicesTab" role="tab" data-toggle="tab">Invoices</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="RecentActivityTab">
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-md-4">
                          <h4>Invoice #3</h4>
                          <label class="label label-warning">Not Paid</label>
                        </div>
                        <div class="col-md-4">
                          <h5>Dated On</h5>
                          07/04/2016
                        </div>
                        <div class="col-md-4">
                          <div class="pull-right">
                            <h5>Amount</h5>
                            <strong>$200.00</strong>
                          </div>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-md-4">
                          <h4>Job #1</h4>
                          <label class="label label-default">Open</label>
                        </div>
                        <div class="col-md-4">
                          <h5>Dated On</h5>
                          07/04/2016
                        </div>
                        <div class="col-md-4">
                          <div class="pull-right">
                            <h5>Amount</h5>
                            <strong>$200.00</strong>
                          </div>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-md-4">
                          <h4>Quote #1</h4>
                          <label class="label label-default">Draft</label>
                        </div>
                        <div class="col-md-4">
                          <h5>Dated On</h5>
                          07/04/2016
                        </div>
                        <div class="col-md-4">
                          <div class="pull-right">
                            <h5>Amount</h5>
                            <strong>$200.00</strong>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="QuotesTab"></div>
                  <div role="tabpanel" class="tab-pane" id="JobsTab"></div>
                  <div role="tabpanel" class="tab-pane" id="InvoicesTab"></div>
                </div>
              </div>
          </div> <!-- ./overview-panel -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>
                Tasks / Tickets
                <div class="pull-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      + New <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="#"><i class="fa fa-tasks"></i> New TaskList</a></li>
                      <li><a href="#"><i class="fa fa-ticket"></i> New Ticket</a></li>
                    </ul>
                  </div>
                </div>
              </h4>
            </div>
            <div class="panel-body">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#TasksTab" role="tab" data-toggle="tab">Tasks</a></li>
                <li><a href="#TicketsTab" role="tab" data-toggle="tab">Tickets</a></li>
              </ul>

              <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="TasksTab">

                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-md-1">
                        <h4><input type="checkbox" name="name" value="1" /></h4>
                      </div>
                      <div class="col-md-4">
                        <h4>visit the dental clinic</h4>
                        <label class="label label-default">Open</label>
                      </div>
                      <div class="col-md-2">
                        <h5>Dated On</h5>
                        07/04/2016
                      </div>
                      <div class="col-md-5">
                        <div class="pull-right">
                          <h5>Assigned To</h5>
                          Satheesh Kumar
                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="link-row">
                    <div class="row">
                      <div class="col-md-1">
                        <h4><input type="checkbox" name="name" value="1" /></h4>
                      </div>
                      <div class="col-md-4">
                        <h4>visit the dental clinic</h4>
                        <label class="label label-default">Open</label>
                      </div>
                      <div class="col-md-2">
                        <h5>Dated On</h5>
                        07/04/2016
                      </div>
                      <div class="col-md-5">
                        <div class="pull-right">
                          <h5>Assigned To</h5>
                          Satheesh Kumar
                        </div>
                      </div>
                    </div>
                  </a>
              </div>

              <div role="tabpanel" class="tab-pane" id="TicketsTab">
                <a href="#" class="link-row">
                  <div class="row">
                    <div class="col-md-4">
                      <h4>Problem in the hms module</h4>
                      <label class="label label-default">Open</label>
                    </div>
                    <div class="col-md-2">
                      <h5>Dated On</h5>
                      07/04/2016
                    </div>
                    <div class="col-md-3">
                      <h5>Project</h5>
                      HMS
                    </div>
                    <div class="col-md-3">
                      <div class="pull-right">
                        <h5>Assigned To</h5>
                        Satheesh Kumar
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
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
                <div class="col-md-6">
                  <h4>Problem in the hms module</h4>
                  <label class="label label-info">Open</label>
                </div>
                <div class="col-md-2">
                  <h5>Dated On</h5>
                  07/04/2016
                </div>
                <div class="col-md-4">
                  <div class="pull-right">
                    <h5>Created By</h5>
                    Satheesh Kumar
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="link-row">
              <div class="row">
                <div class="col-md-6">
                  <h4>Problem in the hms module</h4>
                  <label class="label label-info">Open</label>
                </div>
                <div class="col-md-2">
                  <h5>Dated On</h5>
                  07/04/2016
                </div>
                <div class="col-md-4">
                  <div class="pull-right">
                    <h5>Created By</h5>
                    Satheesh Kumar
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="link-row">
              <div class="row">
                <div class="col-md-6">
                  <h4>Problem in the hms module</h4>
                  <label class="label label-default">Closed</label>
                </div>
                <div class="col-md-2">
                  <h5>Dated On</h5>
                  07/04/2016
                </div>
                <div class="col-md-4">
                  <div class="pull-right">
                    <h5>Created By</h5>
                    Satheesh Kumar
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="client-details-panel">
          <table class="table table-striped">
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
        </div> <!-- ./client-details-panel -->
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
                <div class="col-md-2">
                  <i class="fa fa-file fa-lg"></i>
                </div>
                <div class="col-md-10">
                  Proposal attachment.pdf
                </div>
              </div>
            </a>
            <a href="#" class="link-row">
              <div class="row">
                <div class="col-md-2">
                  <i class="fa fa-file fa-lg"></i>
                </div>
                <div class="col-md-10">
                  Proposal attachment.pdf
                </div>
              </div>
            </a>
          </div>
        </div> <!-- ./ files-panel -->
        <div class="">
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
  </div>

@endsection
