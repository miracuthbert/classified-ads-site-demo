<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials._head')

        <!-- layout custom style -->
        <link href="{{ url('themes/messenger/css/custom.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            @include('layouts.messenger.partials._navigation')

            <div class="container-fluid">
                @include('layouts.partials._alerts')

                @yield('content')
            </div>
        </div>

        @include('layouts.partials._scripts')

        <!-- layout custom scripts -->
        <script src="{{ url('themes/messenger/js/custom.js') }}"></script>
    </body>
</html>
