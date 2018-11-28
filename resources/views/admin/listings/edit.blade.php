@component('layouts.admin.master')

@section('title')
    {{ $listing->title  }}
@endsection

@slot('page_theme_name') {{ 'item-editor' }} @endslot

@section('content')
    <div class="title-search-block">
        <div class="title-block">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title"><i class="fa fa-edit"></i> Edit Listing
                        @if(!$listing->live())
                            <a href="{{ route('listings.show', [$area, $listing]) }}"
                               class="btn btn-primary btn-sm rounded-s">Go to listing</a>
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.listings.update', [$listing]) }}">
        <div class="card">
            <div class="card-block">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="form-control-label">Title</label>

                    <p class="form-static-control" id="title">{{ $listing->title }}</p>
                </div>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="owner" class="form-control-label">Posted by</label>

                    <p class="form-static-control"
                       id="owner">{{ $listing->user->first_name }} {{ $listing->user->last_name }}
                        <a href="">Send Message</a></p>
                </div>

                <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                    <label for="area" class="control-label">Area</label>
                    <p class="form-control-static" id="area">{{ $listing->area->name }}</p>
                </div>

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="control-label">Category</label>
                    <p class="form-control-static" id="category">{{ $listing->category->name }}</p>
                </div>

                <div class="form-group{{ $errors->has('views') ? ' has-error' : '' }}">
                    <label for="views" class="control-label">Views</label>
                    <p class="form-control-static" id="views">{{ $listing->views() }}</p>
                </div>

                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="body" class="form-control-label">Body</label>

                    <div class="form-static-control" id="body">
                        {!! $listing->body !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="form-control-label">Status</label>
                    <p class="form-static-control" id="status">{{ !$listing->live() ? 'Not live' : 'Live' }}</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group clearfix">
                    <button type="submit" name="block_listing" class="btn btn-danger" value="1">
                        <i class="fa fa-ban"></i> Block
                    </button>

                    <button type="submit" name="flag_listing" class="btn btn-warning" value="1">
                        <i class="fa fa-flag"></i> Flag
                    </button>
                </div>
            </div>
        </div>
    </form>

@endsection

@endcomponent