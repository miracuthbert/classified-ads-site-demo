@component('admin.listings.partials._base_listing', compact('listing'))

    @slot('owner')

        <div class="item-col item-col-author">
            <div class="item-heading">Author</div>
            <div class="no-overflow">
                <a href="{{ route('admin.users.edit', [$listing->user]) }}">{{ $listing->user->first_name }} {{ $listing->user->last_name }}</a>
            </div>
        </div>

    @endslot

    @slot('listing_area')

        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Area</div>
            <div class="no-overflow">
                <a href="{{ route('admin.listings.index', ['area' => $listing->area]) }}">{{ $listing->area->name }}</a>
            </div>
        </div>

    @endslot

    @slot('category')

        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Category</div>
            <div class="no-overflow">
                <a href="{{ route('admin.listings.index', ['category' => $listing->category]) }}">{{ $listing->category->name }}</a>
            </div>
        </div>

    @endslot

@endcomponent