@component('layouts.admin.master')

    @section('title')
        {{ $user->first_name }} {{ $user->last_name }}
    @endsection

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-edit"></i> Edit User <span class="sparkline bar" data-type="bar"></span> </h3>
        </div>
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.users.update', [$user]) }}">
            {{ method_field('put') }}
            {{ csrf_field() }}

            <div class="card">
                <div class="card-header">
                    <div class="header-block">
                        <div class="title">User details</div>
                    </div>
                </div>
                <div class="card-block">

                    <div class="form-group row{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-4 form-control-label">First name</label>

                        <div class="col-md-6">
                            <p class="form-static-control">{{ $user->first_name }}</p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-4 form-control-label">Last name</label>

                        <div class="col-md-6">
                            <p class="form-static-control">{{ $user->last_name }}</p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 form-control-label">Username</label>

                        <div class="col-md-6">
                            <p class="form-static-control">{{ $user->username }}</p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 form-control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <p class="form-static-control" id="email">{{ $user->email }} <a href="">Send message</a></p>
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-4 form-control-label">Country</label>

                        <div class="col-md-6">
                            <p class="form-static-control" id="country">{{ $user->country }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="listings" class="col-md-4 form-control-label">Listings</label>

                        <div class="col-md-6">
                            <p class="form-static-control" id="listings">{{ $user->listings->count() }}</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mt-1">
                <div class="card-header">
                    <div class="header-block">
                        <div class="title">Roles</div>
                    </div>
                </div>
                <div class="card-block">
                    <h6 class="card-subtitle">User roles will appear here.</h6>
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
                                    <div> <span>Role</span> </div>
                                </div>
                                <div class="item-col item-col-header item-col-date">
                                    <div class="no-overflow"><span>Since</span></div>
                                </div>
                                <div class="item-col item-col-header item-col-date">
                                    <div><span>Expires At</span></div>
                                </div>
                                <div class="item-col item-col-header fixed item-col-actions-dropdown"></div>
                            </div>
                        </li>

                        <li class="item">
                            <div class="item-row">
                                <div class="item-col fixed item-col-check"> <label class="item-check" id="select-all-items">
                                        <input type="checkbox" class="checkbox">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="item-col item-col-title no-overflow">
                                    <div class="item-heading">Role</div>
                                    <div>
                                        <a href="item-editor.html" class="">
                                            <h4 class="item-title no-wrap"> Role </h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="item-col item-col-date">
                                    <div class="item-heading">Since</div>
                                    <div class="no-overflow"> 21 SEP 10:45 </div>
                                </div>
                                <div class="item-col item-col-date">
                                    <div class="item-heading">Expires At</div>
                                    <div class="no-overflow"> - </div>
                                </div>
                                <div class="item-col fixed item-col-actions-dropdown">
                                    <div class="item-actions-dropdown">
                                        <a class="item-actions-toggle-btn">
                                            <span class="inactive">
                                                <i class="fa fa-cog"></i>
                                            </span>
                                            <span class="active">
                                            <i class="fa fa-chevron-circle-right"></i>
                                            </span>
                                        </a>
                                        <div class="item-actions-block">
                                            <ul class="item-actions-list">
                                                <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                                                        <i class="fa fa-trash-o "></i>
                                                    </a> </li>
                                                <li> <a class="edit" href="item-editor.html">
                                                        <i class="fa fa-pencil"></i>
                                                    </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-secondary">Assign new roles</a>
                </div>
            </div>
        </form>
    @endsection

@endcomponent