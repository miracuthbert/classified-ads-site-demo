<div class="col-xl-8">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
        <div class="card-header bordered">
            <div class="header-block">
                <h3 class="title"> Listings </h3> <a href="item-editor.html" class="btn btn-primary btn-sm rounded">
                    Add new
                </a></div>
            <div class="header-block pull-right"><label class="search">
                    <input class="search-input" placeholder="search...">
                    <i class="fa fa-search search-icon"></i>
                </label>
                <div class="pagination"><a href="" class="btn btn-primary btn-sm rounded">
                        <i class="fa fa-angle-up"></i>
                    </a> <a href="" class="btn btn-primary btn-sm rounded">
                        <i class="fa fa-angle-down"></i>
                    </a></div>
            </div>
        </div>
        <ul class="item-list striped">
            <li class="item item-list-header hidden-sm-down">
                <div class="item-row">
                    <div class="item-col item-col-header fixed item-col-img xs"></div>
                    <div class="item-col item-col-header item-col-title">
                        <div><span>Name</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-sales">
                        <div><span>Sales</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-stats">
                        <div class="no-overflow"><span>Views</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-category">
                        <div class="no-overflow"><span>Area</span></div>
                    </div>
                    <div class="item-col item-col-header item-col-date">
                        <div><span>Published</span></div>
                    </div>
                </div>
            </li>
            @foreach($latest_listings as $listing)
                @include('admin.listings.partials._dashboard_listing')
            @endforeach
        </ul>
    </div>
</div>
