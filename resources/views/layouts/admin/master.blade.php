<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.admin.partials._head')
</head>

<body>

<div class="main-wrapper">
    <div class="app" id="app">
        @include('layouts.admin.partials._header')

        @include('layouts.admin.partials._sidebar')

        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <article class="content {{ $page_theme_name or '' }}-page @yield('content-styles')">
            @include('layouts.admin.partials._alerts')

            @yield('content')
        </article>

        @include('layouts.admin.partials._footer')

        @include('layouts.admin.partials._media_modal')

        @include('layouts.admin.partials._confirm_modal')
    </div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>

@include('layouts.admin.partials._scripts')
</body>

</html>