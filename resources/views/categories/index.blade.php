@extends('layouts.app')

@section('title')
    {{ $area->name }}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('listings.partials._search')
            <hr>

            @foreach($categories as $parent)
                <div class="row">
                    @foreach($parent->children as $category)
                        <div class="col-sm-12">
                            <h4>{{ $category->name }}</h4>
                            <hr>
                            @foreach($category->children->chunk(3) as $subs)
                                <div class="row">
                                    @foreach($subs as $sub)
                                        <div class="col-sm-4">
                                            <h5>
                                                <a href="{{ route('listings.index', [$area, $sub]) }}">{{ $sub->name }}
                                                    ({{ $sub->listings_count }})</a>
                                            </h5>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
