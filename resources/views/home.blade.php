@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                @foreach($areas as $country)
                    <div class="col-sm-12">
                        <h3><a href="{{ route('user.area.store', $country) }}">{{ $country->name }}</a></h3>
                        <hr>

                        <div class="row">
                            @foreach($country->children as $state)
                                <div class="col-sm-4">
                                    <h4><a href="{{ route('user.area.store', $state) }}">{{ $state->name }}</a></h4>
                                    <hr class="{{ !$state->children->count() ? 'hidden' : '' }}">

                                    @foreach($state->children as $city)
                                        <h5><a href="{{ route('user.area.store', $city) }}">{{ $city->name }}</a></h5>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
