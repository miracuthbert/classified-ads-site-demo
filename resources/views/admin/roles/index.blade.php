@component('layouts.admin.master')

    @section('title', 'Roles')

    @slot('page_theme_name') {{ 'items-list' }} @endslot

    @section('content')
        <div class="title-search-block">
            <div class="title-block">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title"><i class="fa fa-universal-access"></i> Roles
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm rounded-s"> Add
                                New </a>
                            <!-- -->
                            <div class="action dropdown">
                                <button class="btn  btn-sm rounded-s btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> More actions...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('users-form').submit();">
                                        <i class="fa fa-message icon"></i> Message users
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirm-modal">
                                        <i class="fa fa-close icon"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </h3>
                        <p class="title-description"> List of users with: listings, contacts, etc... </p>
                    </div>
                </div>
            </div>
            <div class="items-search">
                <form class="form-inline">
                    <div class="input-group"><input type="text" class="form-control boxed rounded-s"
                                                    placeholder="Search for..."> <span class="input-group-btn">
                            <button class="btn btn-secondary rounded-s" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span></div>
                </form>
            </div>
        </div>
        <div class="card items">
            <ul class="item-list striped">
                <li class="item item-list-header hidden-sm-down">
                    <div class="item-row">
                        <div class="item-col fixed item-col-check"><label class="item-check" id="select-all-items">
                                <input type="checkbox" class="checkbox">
                                <span></span>
                            </label></div>
                        <div class="item-col item-col-header item-col-title">
                            <div><span>Title</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-category">
                            <div><span>Slug</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-stats">
                            <div class="no-overflow"><span>Users</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-category">
                            <div class="no-overflow"><span>Status</span></div>
                        </div>
                        <div class="item-col item-col-header item-col-date">
                            <div class="no-overflow"><span>Added</span></div>
                        </div>
                        <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                    </div>
                </li>

                @forelse($roles as $role)
                    @include('admin.roles.partials._listing')
                @empty
                    <div class="mt-1 text-center lead">No roles found.</div>
                @endforelse
            </ul>
        </div>
    @endsection

@endcomponent