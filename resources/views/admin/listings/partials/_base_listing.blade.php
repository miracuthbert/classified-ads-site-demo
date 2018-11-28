<li class="item">
    <div class="item-row">
        <div class="item-col fixed item-col-check"><label class="item-check" id="select-all-items">
                <input type="checkbox" name="users[]" class="checkbox" value="{{ $listing->id }}">
                <span></span>
            </label></div>
        <div class="item-col fixed item-col-img xs">
            <a href="">
                <div class="item-img xs rounded"
                     style="background-image: url({{ !empty($listing->image) ? url($listing->image) : '' }})"></div>
            </a>
        </div>
        <div class="item-col item-col-title no-overflow">
            <div>
                <a href="{{ route('admin.listings.edit', [$listing]) }}" class="">
                    <h4 class="item-title no-wrap"> {{ $listing->title }} </h4>
                </a>
            </div>
        </div>
        {{ $owner or '' }}
        <div class="item-col item-col-sales">
            <div class="item-heading">Contacts</div>
            <div> 4958 </div>
        </div>
        <div class="item-col item-col-stats">
            <div class="item-heading">Views</div>
            <div class="no-overflow">
                <div class="item-stats"> {{ $listing->views() }} </div>
            </div>
        </div>
        {{ $listing_area or '' }}
        {{ $category or '' }}
        <div class="item-col item-col-date">
            <div class="item-heading">Published</div>
            <div> {{ $listing->created_at->diffForHumans() }}</div>
        </div>
    </div>
</li>