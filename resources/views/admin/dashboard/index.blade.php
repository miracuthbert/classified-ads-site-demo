@component('layouts.admin.master')

    @section('title')
        Dashboard
    @endsection

    @slot('page_theme_name') {{ 'dashboard' }} @endslot

    @section('content')

        <section class="section">
            <div class="row sameheight-container">
                @include('admin.dashboard.partials._stats')

                @include('admin.dashboard.partials._charts')
            </div>
        </section>

        <section class="section">
            <div class="row sameheight-container">
                @include('admin.dashboard.partials._listings')
            </div>
        </section>

    @endsection

@endcomponent