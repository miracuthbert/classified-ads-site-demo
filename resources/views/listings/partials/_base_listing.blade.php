<div class="media">
    <div class="media-body">
        <h5>
            <strong>
                <a href="{{ route('listings.show', [$area, $listing]) }}">{{ $listing->title }}</a>
            </strong>

            @if($area->children->count())
                in {{ $listing->area->name }}
            @endif
        </h5>

        <ul class="list-inline">
            <li>
                <time>{{ $listing->created_at->diffForHumans() }}</time>
            </li>
            <li>
                {{ $listing->user->first_name }} {{ $listing->user->last_name }}
            </li>
            <li>
                Viewed {{ $listing->views() }} times
            </li>
        </ul>

        {{ $links or ''}}
    </div>
</div>
