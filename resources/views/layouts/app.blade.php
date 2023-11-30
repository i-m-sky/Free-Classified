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
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="robots" content="noindex">
     {{-- Icon with dropdown  css--}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css'>
    
    
    <link rel="icon" type="image/x-icon" href="/favicon.ico" width="32px" height="32px"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,500;0,600;0,700;1,400&family=Lato:wght@400;700;900&display=swap"
        rel="stylesheet">
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64674a49e298d600199b3f0f&product=sop' async='async'></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    @livewireStyles
   <link rel="stylesheet" type="text/css" href="{{ config('global_variables.asset_url') }}/css/slick.css" />
    <link rel="stylesheet" href="{{ config('global_variables.asset_url') }}/css/style.css" />
    <link rel="stylesheet" href="{{ config('global_variables.asset_url') }}/css/theme.css" />
    <link rel="stylesheet" href="{{ config('global_variables.asset_url') }}/css/responsive.css" />
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
    @livewire('livewire-ui-modal')
    @yield('bodyend')
</body>

</html>
