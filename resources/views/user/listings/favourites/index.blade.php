@extends('layouts.app')

@section('title')
    Favourite Listings
@endsection

@section('content')

    <h3 class="page-header">Favourite Listings</h3>

    @forelse($listings as $listing)
        @include('listings.partials._listing_favourite', compact('listing'))
    @empty
        <p class="lead">No favourite listings.</p>
    @endforelse

    @if($listings->count())
        <hr>
        Showing {{ $listings->firstItem() }} to {{ $listings->lastItem() }} of {{ $listings->total() }}
        <hr>
        {{ $listings->render() }}
    @endif
@endsection
