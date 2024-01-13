<!DOCTYPE html>
<html lang="en">

<head>
    @php
    $location = '';
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    @hasSection('metatags')
    @yield('metatags')
    @else
    <title>{{ isset($row) ? str_replace('@location', $location, $row->meta_title) : 'Adpost' }}</title>
    <meta name="description"
        content="{{ isset($row) ? str_replace('<br />', ' ', str_replace('@location', $location, $row->meta_description)) : 'Adpost' }}" />
    <meta name="keywords"
        content="{{ isset($row) ? str_replace('<br />', ' ', str_replace('@location', $location, $row->meta_keyword)) : 'Adpost' }}" />
    <meta property="og:title"
        content="{{ isset($row) ? str_replace('@location', $location, $row->meta_title) : 'Adpost' }}">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }} ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Icon with dropdown  css--}}

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
    <link rel="manifest" href="/icons/site.webmanifest">
    <link rel="mask-icon" href="/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,500;0,600;0,700;1,400&family=Lato:wght@400;700;900&display=swap"
        rel="stylesheet">

    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=64674a49e298d600199b3f0f&product=sop'
        async='async'></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="{{ config('global_variables.asset_url') }}/css/slick.css" />
    <link rel="stylesheet" href="{{ config('global_variables.asset_url') }}/css/style.css" />
    <link rel="stylesheet" href="{{ config('global_variables.asset_url') }}/css/theme.css" />
    <link rel="stylesheet" href="{{ config('global_variables.asset_url') }}/css/responsive.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    @yield('headend')
</head>

<body class="@yield('bodyclass')">
    <livewire:shared.header />
    @yield('content')
    <livewire:shared.footer />
    @livewireScripts
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://kit.fontawesome.com/e088578515.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ config('global_variables.asset_url') }}/js/slick.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js'></script>
    <script src="{{ config('global_variables.asset_url') }}/js/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    @livewire('livewire-ui-modal')
    @yield('bodyend')
</body>

</html>