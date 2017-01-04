<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('build/css/ns-style-growl.css') }}">
    <link rel="stylesheet" href="{{ url('build/css/ns-default.css') }}">
    <link rel="stylesheet" href="{{ url('build/css/ns-style-theme.css') }}">
    <link rel="stylesheet" href="{{ url('build/css/bootstrap-datepicker.min.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">

    {{-- Page Header --}}
    <header class="navbar" id="header-navbar">
        @include('partials.header')
    </header>

    <div id="page-wrapper" class="container">
        <div class="row">

            <div id="nav-col">
                {{-- Sidebar --}}
                @include('partials/sidebar')
            </div>

            <div id="content-wrapper">

                {{--Alerts--}}
                @include('partials/alerts')

                @yield('content')
            </div>

        </div>
    </div>
</div>

{{-- Modals --}}
@include('partials/modal-confirm')

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>

{{-- Call custom inline scripts --}}
@yield('scripts')

<script type="text/javascript">
    $(function() {

        $('[data-toggle="tooltip"]').tooltip();

        @if (Session::has('flash_notification.message'))
            swal({
            title: "{{ Session::get('flash_notification.title') }}",
            type:  "{{ Session::get('flash_notification.level') }}",
            text:  "{{ Session::get('flash_notification.message') }}",
            timer: 1000
        });
        @endif
    });
</script>

<!-- Encode Locale Files to JSON to use in Javascript components. -->
<script>
    window.transResource = <?php
    // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
    $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
    $trans = [];
    foreach ($lang_files as $f) {
        $filename = pathinfo($f)['filename'];
        $trans[$filename] = trans($filename);
    }
    echo json_encode($trans);
    ?>;
</script>

</body>
</html>