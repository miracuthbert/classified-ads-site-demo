@extends('layouts.app')

@section('title')
    M-pesa Payment Instructions
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>M-pesa Payment Instructions</h4>
                    <span class="text-muted">Follow instructions below to make payment via M-pesa</span>
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

                    <ol>
                        <li>Send payment to phone no: +255766038905 for Tanzania under name (Cuthbert Mirambo);
                            +254724308266 for Kenya under name (Cuthbert Mirambo)
                        </li>
                        <li>After payment is received your listing will be made live shortly.</li>
                        <li><strong>Note: </strong>If listing is not made live after payment, forward the SMS details to the respective phone no.</li>
                    </ol>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('listings.edit', [$area, $listing]) }}" class="btn btn-default">
                        <i class="fa fa-chevron-circle-left"></i> Return to editing
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection