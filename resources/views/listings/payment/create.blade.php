@extends('layouts.app')

@section('title')
    Listing Payment
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Listing Payment</h4>
                    <span class="text-muted">Pay for your listing</span>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="" class="control-label">Listing</label>
                        <p class="form-control-static">{{ $listing->title }} in <em>{{ $listing->area->name }}</em></p>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Category</label>
                        <p class="form-control-static">{{ $listing->category->name }}</p>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Price</label>
                        <p class="form-control-static">$. {{ number_format($listing->cost(), 2) }}</p>
                    </div>

                    <hr>

                    @if($listing->cost() == 0)
                        <form action="{{ route('listings.payment.update', [$area, $listing]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <p class="lead">There is nothing for you to pay.</p>
                            <button class="btn btn-success">Complete</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('listings.payment.store', [$area, $listing]) }}">
                            {{ csrf_field() }}

                            <div class="form-group clearfix">
                                <a href="{{ route('listings.edit', [$area, $listing]) }}" class="btn btn-default">
                                    <i class="fa fa-chevron-circle-left"></i> Continue editing
                                </a>

                                <div class="pull-right">
                                    <button type="submit" name="pay_mpesa" class="btn btn-success" value="true">
                                        Pay via M-pesa
                                    </button>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary">Pay with PayPal</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
