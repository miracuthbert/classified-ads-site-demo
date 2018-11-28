<div class="media">
    <div class="media-body">

        <h5><strong>{{ $listing->title }}</strong> in {{ $listing->area->name }}</h5>

        <ul class="list-inline">
            <li>Deleted
                <time>{{ $listing->deleted_at->diffForHumans() }}</time>
            </li>
        </ul>

        <ul class="list-inline">
            <li>
                <a href="#" class="text-danger"
                   onclick="event.preventDefault(); document.getElementById('listing-destroy-{{ $listing->id }}-form').submit();">
                    Delete</a>

                <form id="listing-destroy-{{ $listing->id }}-form"
                      action="{{ route('listings.destroy', [$area, $listing]) }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </li>
            <li>
                <a href="#" class="text-success"
                   onclick="event.preventDefault(); document.getElementById('listing-restore-{{ $listing->id }}-form').submit();">Restore</a>
                <form id="listing-restore-{{ $listing->id }}-form"
                      action="{{ route('listings.restore', [$area, $listing]) }}"
                      method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                </form>
            </li>
        </ul>
    </div>
</div>
