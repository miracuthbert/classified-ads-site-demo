@extends('layouts.app')

@section('title', 'Deleted Listings')

@section('content')

    <h3 class="page-header">Deleted Listings <span class="badge">{{ $listings->total() }}</span></h3>

    @forelse($listings as $listing)
        @include('listings.partials._listing_own_deleted', compact('listing'))
    @empty
        <p class="lead">No deleted listings.</p>
    @endforelse

    @if($listings->count())
        <hr>
        Showing {{ $listings->firstItem() }} to {{ $listings->lastItem() }} of {{ $listings->total() }}
        <hr>
        {{ $listings->render() }}
    @endif
@endsection
