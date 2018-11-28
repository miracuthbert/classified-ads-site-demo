@extends('layouts.app')

@section('title')
    Recently Viewed Listings
@endsection

@section('content')

    <h3 class="page-header">Recently Viewed Listings</h3>
    <p>Showing your last {{ $indexLimit }} viewed listings.</p>

    @forelse($listings as $listing)
        @component('listings.partials._listing', compact('listing'))

        @slot('links')
        <ul class="list-inline">
            <li>Viewed {{ $listing->pivot->updated_at->diffForHumans() }}</li>
        </ul>
        @endslot

        @endcomponent
    @empty
        <p class="lead">You have no viewed listings.</p>
    @endforelse

@endsection
