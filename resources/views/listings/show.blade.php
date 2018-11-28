@extends('layouts.app')

@section('title')
    {{ $listing->title }}
@endsection

@section('content')
    <div class="row">
        @if(Auth::check())
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <nav class="nav nav-stacked">
                            <li>
                                <a href="">Email to a friend</a>
                            </li>
                            @if(!$listing->favouritedBy(Auth::user()))
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault(); document.getElementById('listings-favourite-form').submit();">Add
                                        to favourites</a>

                                    <form id="listings-favourite-form"
                                          action="{{ route('listings.favourite.store', [$area, $listing]) }}"
                                          method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif

                            @can('Edit', $listing)
                                <li>
                                    <a href="{{ route('listings.edit', [$area, $listing]) }}">Edit listing</a>
                                </li>
                            @endcan
                        </nav>
                    </div>
                </div>
            </div>
        @endif
        <div class="{{ Auth::check() ? 'col-md-9' : 'col-md-12' }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $listing->title }} in <span class="text-muted">{{ $listing->area->name }}</span></h4>
                </div>
                <div class="panel-body">
                    {!! ($listing->body) !!}

                    <hr>

                    <p>Viewed {{ $listing->views() }} times</p>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="lead">Contact {{ $listing->user->first_name }} {{ $listing->user->last_name }}</span>
                </div>
                <div class="panel-body">
                    @if(Auth::guest())
                        <p><a href="{{ route('register') }}">Sign up</a> for an account or
                            <a href="{{ route('login') }}">sign in</a> to contact listing owners.</p>
                    @else
                        @cannot('touch', $listing)
                            <form method="post" action="{{ route('listings.contact.store', [$area, $listing]) }}"
                                  name="listing-contact-form">

                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <label for="message" class="control-label">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="5"
                                              class="form-control tm_comment"
                                              placeholder="Enter your message here"></textarea>

                                    @if($errors->has('message'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    <span class="help-block">This will email {{ $listing->user->first_name }} {{ $listing->user->last_name }}
                                        and they will be able to reply directly to you by email.</span>
                                </div>
                            </form>
                        @endcannot
                        @can('touch', $listing)
                            <p class="lead">You cannot send a message to yourself.</p>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection