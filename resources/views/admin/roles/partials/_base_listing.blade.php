<li class="item">
    <div class="item-row">
        <div class="item-col fixed item-col-check"><label class="item-check" id="select-all-items">
                <input type="checkbox" name="users[]" class="checkbox" value="{{ $role->id }}">
                <span></span>
            </label></div>
        <div class="item-col fixed pull-left item-col-title">
            <div class="item-heading">Title</div>
            <div>
                <a href="{{ route('admin.roles.edit', [$role]) }}" class="">
                    <h4 class="item-title"> {{ $role->title }}</h4>
                </a>
            </div>
        </div>
        <div class="item-col item-col-category">
            <div class="item-heading">Slug</div>
            <div><a href="">{{ $role->slug }}</a></div>
        </div>
        <div class="item-col item-col-stats no-overflow">
            <div class="item-heading">Listings</div>
            <div class="no-overflow">
                <div class="item-stats">{{ $role->users->count() }}</div>
            </div>
        </div>
        <div class="item-col item-col-category no-overflow">
            <div class="item-heading">Status</div>
            <div class="no-overflow">
                <a href="">{{ $role->status ? 'Active' : 'Disabled' }}</a>
            </div>
        </div>
        <div class="item-col item-col-date">
            <div class="item-heading">Added</div>
            <div class="no-overflow">{{ $role->created_at->diffForHumans() }}</div>
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
                            <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal-{{ $role->id }}">
                                <i class="fa fa-trash-o "></i>
                            </a>

                            <form id="role-destroy-{{ $role->id }}-form"
                                  action="{{ route('admin.roles.destroy', [$role]) }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>

                            @include('layouts.admin.partials._confirm_modal', ['modal_id' => "confirm-modal-{$role->id}", 'title' => "Delete Confirmation", 'message' => "Are you sure you want to delete {$role->title}?", 'action' => "role-destroy-{$role->id}-form"])
                        </li>
                        <li>
                            <a class="edit" href="{{ route('admin.roles.edit', [$role]) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>