<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="author" content="HomeBid">
<!-- Place favicon.ico in the root directory -->
<link rel="stylesheet" href="">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') - Admin | {{ config('app.name') }}</title>

<!-- Main Fonts -->
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400italic,700italic,700,400'>

<!-- Vendor CSS -->
<link href="{{ url('themes/modularadmin/css/vendor.css') }}" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="{{ url('vendor/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Theme initialization -->
<script>
    var cssPath = "{{ url('themes/modularadmin/css') }}";
    var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
    {};
    var themeName = themeSettings.themeName || '';
    if (themeName) {
        document.write('<link rel="stylesheet" id="theme-style" href="' + cssPath + '/app-' + themeName + '.css">');
    }
    else {
        document.write('<link rel="stylesheet" id="theme-style" href="' + cssPath + '/app.css">');
    }
</script>
<!-- Your custom styles (optional) -->
<link href="{{ url('admin/css/style.css') }}" rel="stylesheet">
