@extends('layouts.app')

@section('title')
    Create Listing
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create listing</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('listings.store', [$area]) }}">
                        {{ csrf_field() }}

                        @include('listings.partials.forms._areas')

                        @include('listings.partials.forms._categories')

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>

                            <input id="title" type="text" class="form-control" name="title"
                                   value="{{ old('title') }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Body</label>

                            <textarea id="body" class="form-control tm_std" name="body" cols="30"
                                      rows="8">{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
