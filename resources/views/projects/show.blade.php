@extends('layout')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="header">
          <h5>
            <a href="#" class="history-back-btn">&larr; Back</a> / <a href="{{ url('projects') }}">Projects</a> / {{ $project->id }}
            <div class="pull-right">
              <a href="#" class="btn btn-sm btn-default"><i class="fa fa-print"></i></a>
              <div class="btn-group">
                <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('projects.edit', $project->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ route('tickets.create') }}?project_number={{ $project->id }}"><i class="fa fa-ticket"></i> New Ticket</a></li>
                  <li><a href="{{ route('quotes.create') }}?project_number={{ $project->id }}"><i class="fa fa-book"></i> New Quote</a></li>
                  <li><a href="#"><i class="fa fa-file"></i> New Invoice</a></li>
                </ul>
              </div>
            </div>
            <div class="clearfix">
              &nbsp;
            </div>
          </h5>
        </div>
        <div class="panel panel-default details-panel-layout">
          <div class="panel-heading details-panel-heading">
            <div class="">
              <h3>
                <i class="fa fa-gavel"></i> <span>{{ $project->title }} #{{ $project->id }}</span>
                <small class="pull-right"><label class="label label-info">Draft</label></small>
              </h3>
              <hr/>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <p>{{ $project->description }}</p>
                @if($project->client != null)
                  <div class="well well-sm">
                    <i class="fa fa-user fa-lg"></i> Client
                    <div class="pull-right">
                      <a href="{{ route('clients.show', $project->client->id) }}">{{ $project->client->name() }}</a>
                    </div>
                  </div>
                @endif
                <div class="form-group">
                  <span>Quick Add</span>
                  <a href="{{ route('tickets.create') }}?project_number={{ $project->id }}" class="btn btn-default btn-sm">
                    <i class="fa fa-ticket"></i> Ticket
                  </a>
                  <a href="{{ route('quotes.create') }}?project_number={{ $project->id }}" class="btn btn-default btn-sm">
                    <i class="fa fa-file"></i> Quote
                  </a>
                </div>
              </div>
              <div class="col-sm-6">
                <br />
                <div class="project-details panel-details">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <td>Project Type</td>
                      <td>{{ $project->project_type }}</td>
                    </tr>
                    <tr>
                      <td>Started On</td>
                      <td>07/04/2016</td>
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
          <div class="panel-body details-panel-body">
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
                          <li><a href="#"><i class="fa fa-tasks"></i> New Task</a></li>
                          <li><a href="{{ route('tickets.create') }}?project_number={{ $project->id }}"><i class="fa fa-ticket"></i> New Ticket</a></li>
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
                          <div class="col-sm-1">
                            <h4><input type="checkbox" name="name" value="1" /></h4>
                          </div>
                          <div class="col-sm-4">
                            <h4>visit the dental clinic</h4>
                            <label class="label label-default">Open</label>
                          </div>
                          <div class="col-sm-2">
                            <h5>Dated On</h5>
                            07/04/2016
                          </div>
                          <div class="col-sm-5">
                            <div class="pull-right">
                              <h5>Assigned To</h5>
                              Satheesh Kumar
                            </div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="link-row">
                        <div class="row">
                          <div class="col-sm-1">
                            <h4><input type="checkbox" name="name" value="1" /></h4>
                          </div>
                          <div class="col-sm-4">
                            <h4>visit the dental clinic</h4>
                            <label class="label label-default">Open</label>
                          </div>
                          <div class="col-sm-2">
                            <h5>Dated On</h5>
                            07/04/2016
                          </div>
                          <div class="col-sm-5">
                            <div class="pull-right">
                              <h5>Assigned To</h5>
                              Satheesh Kumar
                            </div>
                          </div>
                        </div>
                      </a>
                  </div>

                  <div role="tabpanel" class="tab-pane" id="TicketsTab">
                    @include('tickets._list', ['tickets' => $project->tickets])
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
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>
                    Billing
                    <div class="pull-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          + New <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('quotes.create') }}?project_number={{ $project->id }}"><i class="fa fa-book"></i> New Quote</a></li>
                          <li><a href="#"><i class="fa fa-file"></i> New Invoice</a></li>
                          <li><a href="#"><i class="fa fa-money"></i> New Payment</a></li>
                        </ul>
                      </div>
                    </div>
                  </h4>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#RecentBillingTab" role="tab" data-toggle="tab">Recent Billing</a></li>
                    <li><a href="#QuotesTab" role="tab" data-toggle="tab">Quotes</a></li>
                    <li><a href="#InvoicesTab" role="tab" data-toggle="tab">Invoices</a></li>
                    <li><a href="#PaymentsTab" role="tab" data-toggle="tab">Payments</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="RecentBillingTab">
                      <a href="#" class="link-row">
                        <div class="row">
                          <div class="col-sm-4">
                            <h4>Invoice #3</h4>
                            <label class="label label-warning">Not Paid</label>
                          </div>
                          <div class="col-sm-4">
                            <h5>Dated On</h5>
                            07/04/2016
                          </div>
                          <div class="col-sm-4">
                            <div class="pull-right">
                              <h5>Amount</h5>
                              <strong>$200.00</strong>
                            </div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="link-row">
                        <div class="row">
                          <div class="col-sm-4">
                            <h4>Payment #12</h4>
                            <label class="label label-info">Paid</label>
                          </div>
                          <div class="col-sm-4">
                            <h5>Dated On</h5>
                            07/04/2016
                          </div>
                          <div class="col-sm-4">
                            <div class="pull-right">
                              <h5>Amount</h5>
                              <strong>$200.00</strong>
                            </div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="link-row">
                        <div class="row">
                          <div class="col-sm-4">
                            <h4>Invoice #1</h4>
                            <label class="label label-info">Paid</label>
                          </div>
                          <div class="col-sm-4">
                            <h5>Dated On</h5>
                            07/04/2016
                          </div>
                          <div class="col-sm-4">
                            <div class="pull-right">
                              <h5>Amount</h5>
                              <strong>$200.00</strong>
                            </div>
                          </div>
                        </div>
                      </a>
                      <a href="#" class="link-row">
                        <div class="row">
                          <div class="col-sm-4">
                            <h4>Quote #1</h4>
                            <label class="label label-default">Draft</label>
                          </div>
                          <div class="col-sm-4">
                            <h5>Dated On</h5>
                            07/04/2016
                          </div>
                          <div class="col-sm-4">
                            <div class="pull-right">
                              <h5>Amount</h5>
                              <strong>$200.00</strong>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="QuotesTab"></div>
                    <div role="tabpanel" class="tab-pane" id="PaymentsTab"></div>
                  </div>
                </div>
            </div> <!-- ./billings-panel -->
            <div class="row">
              <div class="col-sm-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4>
                      Attachments
                    </h4>
                  </div>
                  <div class="panel-body">
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-xs-2">
                          <i class="fa fa-file fa-lg"></i>
                        </div>
                        <div class="col-xs-8">
                          Proposal attachment.pdf
                        </div>
                        <div class="col-xs-2">
                          <i class="fa fa-trash-o"></i>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-xs-2">
                          <i class="fa fa-file fa-lg"></i>
                        </div>
                        <div class="col-xs-8">
                          Proposal attachment.pdf
                        </div>
                        <div class="col-xs-2">
                          <i class="fa fa-trash-o"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="panel-footer">
                    <div class="input-group">
                      <input type="file" name="name" value="" class="" />
                      <span class="input-group-btn">
                        <button type="button" name="upload-file" class="btn btn-sm btn-default">Upload</button>
                      </span>
                    </div>


                  </div>
                </div> <!-- ./files-panel -->
              </div>
              <div class="col-sm-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4>
                      Notes
                      <div class="pull-right">
                        <a href="#" class="btn btn-sm btn-default"><i class="fa fa-file"></i> New Note</a>
                      </div>
                    </h4>
                  </div>
                  <div class="panel-body">
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-xs-10">
                          Reference url is stored in here...
                        </div>
                        <div class="col-xs-2">
                          <i class="fa fa-trash-o"></i>
                        </div>
                      </div>
                    </a>
                    <a href="#" class="link-row">
                      <div class="row">
                        <div class="col-xs-10">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </div>
                        <div class="col-xs-2">
                          <i class="fa fa-trash-o"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                </div> <!-- ./notes-panel -->
              </div>
            </div>
          </div> <!-- ./details-panel-body -->
          <div class="panel-footer">
            <div class="">
              <span>Note: Deleting this project will remove its tasks, tickets, discussions, etc.</span>
              <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;" class="pull-right" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="btn-group pull-right" role="group" aria-label="">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                </div>
              </form>
              <div class="clearfix"></div>
            </div>
          </div>
        </div> <!-- ./details-panel-layout -->
    </div>
</div>
@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#serviceItemSortable").sortable({
            placeholder: "ui-state-highlight",
            helper: 'clone'
        });
    });
  </script>
@endsection
