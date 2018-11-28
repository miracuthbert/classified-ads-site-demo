<li class="item">
    <div class="item-row">
        <div class="item-col fixed item-col-check"><label class="item-check" id="select-all-items">
                <input type="checkbox" name="users[]" class="checkbox" value="{{ $user->id }}">
                <span></span>
            </label></div>
        <div class="item-col fixed item-col-img md">
            <a href="{{ route('admin.users.edit', [$user]) }}">
                <div class="item-img rounded"
                     style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/_everaldo/128.jpg)"></div>
            </a>
        </div>
        <div class="item-col fixed pull-left item-col-title">
            <div class="item-heading">Name</div>
            <div>
                <a href="{{ route('admin.users.edit', [$user]) }}" class="">
                    <h4 class="item-title"> {{ $user->first_name }} {{ $user->last_name }}</h4>
                </a>
                <span class="badge-pill badge-{{ $user->verified() == 1 ? 'success' : 'warning' }}">{{ $user->verified() == 1 ? 'Verified' : 'Not Verified' }}</span>
            </div>
        </div>
        <div class="item-col item-col-sales">
            <div class="item-heading">Contacts</div>
            <div> 4567</div>
        </div>
        <div class="item-col item-col-stats no-overflow">
            <div class="item-heading">Listings</div>
            <div class="no-overflow">
                <div class="item-stats">{{ $user->listings_count }}</div>
            </div>
        </div>
        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Country</div>
            <div class="no-overflow">
                <a href="{{ route('admin.users.index', ['country' => $user->country]) }}">{{ $user->country or 'Unknown' }}</a>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Last Seen</div>
            <div class="no-overflow">{{ $user->last_login() }}</div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Joined</div>
            <div class="no-overflow"> {{ $user->created_at->diffForHumans() }}</div>
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
                        <li>
                            <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal-{{ $user->id }}">
                                <i class="fa fa-trash-o "></i>
                            </a>

                            <form id="user-destroy-{{ $user->id }}-form"
                                  action="{{ route('admin.users.destroy', [$user]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$user->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete {$user->first_name} {$user->last_name}?", 'action' => "user-destroy-{$user->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.users.edit', [$user]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>