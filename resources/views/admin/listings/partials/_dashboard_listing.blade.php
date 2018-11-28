@component('admin.listings.partials._base_listing', compact('listing'))

    @slot('listing_area')

    <div class="item-col item-col-category no-overflow">
        <div class="item-heading">Area</div>
        <div class="no-overflow">
            <a href="{{ route('admin.listings.index', ['area' => $listing->area]) }}">{{ $listing->area->name }}</a>
        </div>
    </div>

    @endslot

@endcomponent