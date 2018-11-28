@extends('layouts.app')

@section('title')
    Share {{ $listing->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Share listing: <em>{{ $listing->title }}</em>
                </div>
                <div class="panel-body">
                    <p>Share this listing with up to 5 people</p>

                    <form method="post" action="{{ route('listings.share.store', [$area, $listing]) }}"
                          name="listing-share-form">

                        {{ csrf_field() }}

                        @foreach(range(0, 4) as $n)
                            <div class="form-group{{ $errors->has('emails.' . $n) ? ' has-error' : '' }}">
                                <label for="email.{{ $n }}" class="control-label hidden">Email Address</label>
                                <input type="email" name="emails[]" id="email.{{ $n }}" class="form-control"
                                       placeholder="Enter {{ $n != 0 ? 'another ' : '' }}email"
                                       value="{{ old('emails.' .$n) }}"/>

                                @if($errors->has('emails.' . $n))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emails.' . $n) }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endforeach

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="control-label">Message (optional)</label>
                            <textarea name="message" id="message" class="form-control" cols="30" rows="5"
                                      placeholder="Enter your message here">{{ old('message') }}</textarea>

                            @if($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Share</button>

                            <span class="help-block">
                                This will email this listing link (with your message) to the emails above.
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection