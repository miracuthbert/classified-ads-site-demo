@extends('layouts.app')

@section('title', 'Unpublished Listings')

@section('content')

    <h3 class="page-header">Unpublished Listings</h3>

    @forelse($listings as $listing)
        @include('listings.partials._listing_own', compact('listing'))
    @empty
        <p class="lead">No unpublished listings.</p>
    @endforelse

    @if($listings->count())
        <hr>
        Showing {{ $listings->firstItem() }} to {{ $listings->lastItem() }} of {{ $listings->total() }}
        <hr>
        {{ $listings->render() }}
    @endif
@endsection
