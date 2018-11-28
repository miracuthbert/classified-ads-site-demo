<div class="media">
    <div class="media-body">

        <h5>
            <strong>
                @if($listing->isLive())
                    <a href="{{ route('listings.show', [$area, $listing]) }}">{{ $listing->title }}</a>
                @else
                    {{ $listing->title }}
                @endif
            </strong>

            in {{ $listing->area->name }}
        </h5>

        <ul class="list-inline">
            <li>Added
                <time>{{ $listing->created_at->diffForHumans() }}</time>
            </li>
            <li>Last updated
                <time>{{ $listing->updated_at->diffForHumans() }}</time>
            </li>
        </ul>

        <ul class="list-inline">
            <li>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('listing-delete-{{ $listing->id }}-form').submit();">
                    Remove</a>

                <form id="listing-delete-{{ $listing->id }}-form"
                      action="{{ route('listings.delete', [$area, $listing]) }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </li>
            <li><a href="{{ route('listings.edit', [$area, $listing]) }}">Edit</a></li>
            @if(!$listing->live())
                <li><a href="{{ route('listings.payment.create', [$area, $listing]) }}">Proceed to payment</a></li>
            @endif
        </ul>
    </div>
</div>
