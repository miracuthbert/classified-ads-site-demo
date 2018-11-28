@component('layouts.admin.master')

    @section('title', 'Edit Role')

    @slot('page_theme_name') {{ 'item-editor' }} @endslot

    @section('content')
        <div class="title-block">
            <h3 class="title"><i class="fa fa-edit"></i> Edit Role <span class="sparkline bar" data-type="bar"></span></h3>
        </div>
        <form class="form-horizontal" role="form" method="POST"
              action="{{ route('admin.roles.update', [$role]) }}">
            {{ method_field('put') }}
            {{ csrf_field() }}

            <div class="card card-block">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 form-control-label text-xs-right">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control boxed" id="title"
                               placeholder="Enter Role Title" value="{{ old('title', $role->title) }}">
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label for="details" class="col-sm-2 form-control-label text-xs-right">Details</label>
                    <div class="col-sm-10">
                            <textarea name="details" rows="5" class="form-control boxed" id="details"
                                      placeholder="Enter Role Details">{{ old('title', $role->details) }}</textarea>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Status</label>
                    <div class="col-sm-10">
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="0" {{ $role->status == 0 ? 'checked' : '' }}>
                            <span>Disabled</span>
                        </label>
                        <label>
                            <input class="radio" name="status" type="radio"
                                   value="1" {{ $role->status == 1 ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label text-xs-right">Policies</label>
                    <div class="col-sm-10">
                        @forelse($role->policies as $policy)
                            <input type="hidden" name="policy[]" value="{{ array_get($policy, 'name') }}">

                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label text-xs-right">{{ array_get($policy, 'name') }}
                                    Policy Model</label>
                                <div class="col-sm-8">
                                    <input type="text" name="model[]" class="form-control boxed"
                                           value="{{ array_get($policy, 'model') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 form-control-label text-xs-right">{{ array_get($policy, 'name') }}
                                    Permissions</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <input class="checkbox" name="{{ array_get($policy, 'name') }}_view"
                                                       type="checkbox"
                                                       value="1" {{ array_get($policy, 'actions.view') == 1 ? 'checked' : '' }}>
                                                <span>View</span>
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>
                                                <input class="checkbox" name="{{ array_get($policy, 'name') }}_create"
                                                       type="checkbox"
                                                       value="1" {{ array_get($policy, 'actions.create') == 1 ? 'checked' : '' }}>
                                                <span>Create</span>
                                            </label>
                                        </div>
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <input class="checkbox" name="{{ array_get($policy, 'name') }}_update"
                                                       type="checkbox"
                                                       value="1" {{ array_get($policy, 'actions.update') == 1 ? 'checked' : '' }}>
                                                <span>Update</span>
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>
                                                <input class="checkbox" name="{{ array_get($policy, 'name') }}_delete"
                                                       type="checkbox"
                                                       value="1" {{ array_get($policy, 'actions.delete') == 1 ? 'checked' : '' }}>
                                                <span>Delete</span>
                                            </label>
                                        </div>
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <input class="checkbox" name="{{ array_get($policy, 'name') }}_touch"
                                                       type="checkbox"
                                                       value="1" {{ array_get($policy, 'actions.touch') == 1 ? 'checked' : '' }}>
                                                <span>Touch</span>
                                            </label>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                            </div>
                            <hr>
                        @empty
                            <span class="help-block">No policies found.</span>
                        @endforelse
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" name="assignRole" class="btn btn-outline-primary pull-right" value="true">
                            Assign Role
                        </button>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.card -->
        </form>
    @endsection

@endcomponent