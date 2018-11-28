<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') - {{ config('app.name', 'HomeBid') }}</title>

<!-- Styles -->
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'user' => [
            'authenticated' => auth()->check(),
            'id' => auth()->check() ? auth()->user()->id : null,
            'name' => auth()->check() ? auth()->user()->first_name . " " . auth()->user()->last_name : null,
            'username' => auth()->check() ? auth()->user()->username : null,
        ]
    ]) !!}
</script>