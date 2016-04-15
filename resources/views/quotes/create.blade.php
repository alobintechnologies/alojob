@extends('layout')

@section('header')
<div class="header">
    <ol class="breadcrumb">
      <li>Back to: <a href="{{ url('quotes') }}">Quotes</a></li>
    </ol>
</div>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
          <form action="{{ route('quotes.store') }}" method="POST" class="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="panel panel-default details-panel-layout">
                  <div class="panel-heading details-panel-heading">
                    <div class="">
                      <h3>
                        <i class="fa fa-quote"></i> <span>Quote #new</span>
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
                        {{--<div class="form-group @if($errors->has('client_id')) has-error @endif">
                          <label for="client_id-field">Client</label>
                          <div class="input-group">
                            <input type="hidden" name="client_id" value="" />
                            <input type="text" id="client_id-field" name="client_name" class="form-control" value=""/>
                            <span class="input-group-btn">
                              <a href="{{ route('clients.create') }}" class="btn btn-warning">+ New</a>
                            </span>
                          </div>
                        </div>--}}
                        <div class="form-group @if($errors->has('project_id')) has-error @endif">
                          <label for="project_id-field">Project</label>
                          <div class="input-group">
                          <input type="hidden" name="project_id" value="" />
                          <input type="text" id="project_id-field" name="project_name" class="form-control" value=""/>
                            <span class="input-group-btn">
                              <a href="{{ route('projects.create') }}" class="btn btn-warning">+ New</a>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <br />
                        <div class="project-details panel-details">
                          <table class="table table-striped table-bordered">
                            <tr>
                              <td width="50%">
                                <label for="quote_number">Quote Number</label>
                              </td>
                              <td>
                                #new
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label for="tax">Tax (%)</label>
                              </td>
                              <td>
                                <input type="text" class="form-control" placeholder="">
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label for="discount">Discount</label>
                              </td>
                              <td>
                                <div class="input-group">
                                  <input type="text" name="discount" value="" class="form-control">
                                  <span class="input-group-btn">
                                    <select class="btn btn-default" name="discount_type">
                                      <option value="%">%</option>
                                      <option value="$">$</option>
                                    </select>
                                  </span>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body details-panel-body">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-sm-6">
                            <strong>Services</strong>
                          </div>
                          <div class="col-sm-2">
                            <strong>Qty</strong>
                          </div>
                          <div class="col-sm-2">
                            <strong>Unit Price</strong>
                          </div>
                          <div class="col-sm-2">
                            <strong>Total</strong>
                          </div>
                        </div>
                        <hr />
                        <div id="serviceItemSortable" class="line-items">
                          <div class="line-item-row">
                            <div class="row">
                              <div class="col-sm-1">
                                <span class="sort-move-icon"><i class="fa fa-sort"></i></span>
                              </div>
                              <div class="col-sm-5">
                                <input type="text" name="service-name" value="" class="form-control" placeholder="Type title of service here..." />
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="service-quantity" value="0" class="form-control" />
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="service-price" value="0.00" class="form-control" />
                              </div>
                              <div class="col-sm-2">
                                <div class="input-group">
                                  <input type="text" name="service-total" value="0.00" class="form-control" />
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-trash"></i></button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="line-item-row">
                            <div class="row">
                              <div class="col-sm-1">
                                <span class="sort-move-icon"><i class="fa fa-sort"></i></span>
                              </div>
                              <div class="col-sm-5">
                                <input type="text" name="service-name" value="" class="form-control" placeholder="Type title of service here..." />
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="service-quantity" value="0" class="form-control" />
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="service-price" value="0.00" class="form-control" />
                              </div>
                              <div class="col-sm-2">
                                <div class="input-group">
                                  <input type="text" name="service-total" value="0.00" class="form-control" />
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-trash"></i></button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="line-item-row">
                            <div class="row">
                              <div class="col-sm-1">
                                <span class="sort-move-icon"><i class="fa fa-sort"></i></span>
                              </div>
                              <div class="col-sm-5">
                                <input type="text" name="service-name" value="" class="form-control" placeholder="Type title of service here..." />
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="service-quantity" value="0" class="form-control" />
                              </div>
                              <div class="col-sm-2">
                                <input type="text" name="service-price" value="0.00" class="form-control" />
                              </div>
                              <div class="col-sm-2">
                                <div class="input-group">
                                  <input type="text" name="service-total" value="0.00" class="form-control" />
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-trash"></i></button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr/>
                        <button type="button" name="button" id="addNewServiceBtn" class="btn btn-sm btn-warning">+ Add Line Item</button>
                        <hr />
                        <div class="row">
                          <div class="col-sm-6">
                            <textarea name="notes" rows="5" class="form-control" placeholder="Notes for client..."></textarea>
                          </div>
                          <div class="col-sm-6">
                            <ul class="list-group">
                              <li class="list-group-item">
                                Subtotal:
                                <div class="pull-right">
                                  <strong>0.00</strong>
                                </div>
                              </li>
                              <li class="list-group-item">
                                Tax (%):
                                <div class="pull-right">
                                  <strong>0.00</strong>
                                </div>
                              </li>
                              <li class="list-group-item">
                                Discount:
                                <div class="pull-right">
                                  <strong>0.00</strong>
                                </div>
                              </li>
                              <li class="list-group-item">
                                <strong>Total:</strong>
                                <div class="pull-right">
                                  <strong>0.00</strong>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div> <!-- ./ services-panel -->
                    <hr/>
                    <div class="pull-right">
                        <a class="btn btn-link btn-sm" href="{{ route('quotes.index') }}"><i class="fa fa-backward"></i> Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div> <!-- ./panel-body -->
              </div>  <!-- ./panel -->
          </form>
      </div> <!-- ./col-sm-12 -->
    </div> <!-- ./row -->
@endsection

@section('layout-footer')
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var quoteController = new QuoteController();
      @if($project)
        quoteController.project("{{ $project->id }}", "{{ $project->title }}");
      @endif
    });
  </script>
@endsection
