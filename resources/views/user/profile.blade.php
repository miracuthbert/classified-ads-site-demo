@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4><i class="fa fa-user"></i> Profile</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ route('user.update', auth()->id()) }}">
                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name"
                                       value="{{ old('first_name') ? old('first_name') : auth()->user()->first_name }}"
                                       required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name"
                                       value="{{ old('last_name')? old('last_name') : auth()->user()->last_name }}"
                                       required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username"
                                       value="{{ old('username')? old('username') : auth()->user()->username }}"
                                       required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email')? old('email') : auth()->user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.panel-default -->
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <div class="panel-title">
                        <h4><i class="fa fa-universal-access"></i> My Roles</h4>
                    </div><!-- /.panel-title -->
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @forelse($roles as $role)
                            <div class="list-group-item">
                                <div class="list-group-item-heading">
                                    <h4>{{ $role->title }}</h4>
                                    <p><strong>Expires at</strong> {{ $role->pivot->expires_at }}</p>
                                </div>
                                <div class="list-group-item-text">
                                    <p>{{ $role->details }}</p>

                                    @foreach(collect($role->policies)->chunk(3) as $policies)
                                        <div class="row">
                                            @foreach($policies as $policy)
                                                <div class="col-sm-4">
                                                    <h5>{{ $policy['name'] }}</h5>
                                                    <hr>
                                                    <ul class="nav">
                                                        @foreach($policy['actions'] as $key => $action)
                                                            <li>{{ title_case($key) }} : {{ $action }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center">
                                <div class="list-group-item-heading">
                                    <h4>No assigned roles found yet.</h4>
                                </div>
                                <div class="list-group-item-text">
                                    <p>Your roles will appear here as they are created.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div><!-- /.panel-body -->
            </div><!-- /.panel-primary -->
        </div>
    </div>
@endsection
