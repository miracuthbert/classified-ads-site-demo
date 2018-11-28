@component('listings.partials._base_listing', compact('listing'))

    @slot('links')
        <ul class="list-inline">
            <li>Added {{ $listing->pivot->created_at->diffForHumans() }}</li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('listings-favourite-destroy-{{ $listing->id }}-form').submit();">
                    Delete</a>

                <form id="listings-favourite-destroy-{{ $listing->id }}-form"
                      action="{{ route('listings.favourite.destroy', [$area, $listing]) }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </li>
            {{--<li><a href="">Contact Owner</a></li>--}}
            {{--<li><a href="">Email to friend</a></li>--}}
        </ul>
    @endslot

@endcomponent