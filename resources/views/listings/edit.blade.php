@extends('layouts.app')

@section('title')
    Edit Listing
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit listing

                    @if($listing->live())
                        <span class="pull-right"><a href="{{ route('listings.show', [$area, $listing]) }}">Go to
                                listing</a></span>
                    @endif
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('listings.update', [$area, $listing]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        @include('listings.partials.forms._areas')

                        @include('listings.partials.forms._categories')

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>

                            <input id="title" type="text" class="form-control" name="title"
                                   value="{{ !empty(old('title')) ? old('title') : $listing->title }}"
                                   required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Body</label>

                            <textarea id="body" class="form-control tm_std" name="body" cols="30"
                                      rows="8">{{ !empty(old('body')) ? old('body') : $listing->body }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-default">
                                Save
                            </button>

                            @if(!$listing->live())
                                <button type="submit" name="payment" class="btn btn-primary pull-right" value="true">
                                    Continue to payment
                                </button>
                            @endif
                        </div>

                        @if($listing->live())
                            <input type="hidden" name="category" value="{{ $listing->category_id }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
