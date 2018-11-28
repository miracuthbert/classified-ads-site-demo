@extends('layouts.app')

@section('title')
    {{ $category->name }} - {{ $area->name }}
@endsection

@section('content')
    @include('listings.partials._search', [
        'category' => $category
    ])
    <hr>

    <h4>{{ $category->parent->name }} &nbsp; > {{ $category->name }} ({{ $listings->total() }})</h4>
    <hr>

    @forelse($listings as $listing)
        @include('listings.partials._listing', compact('listing'))
    @empty
        <p class="lead">No listings found. <a href="{{ route('listings.create', [$area]) }}">Post one now!</a></p>
    @endforelse

    @if($listings->count())
        <hr>
        Showing {{ $listings->firstItem() }} to {{ $listings->lastItem() }} of {{ $listings->total() }}
        <hr>
        {{ $listings->render() }}
    @endif
@endsection
