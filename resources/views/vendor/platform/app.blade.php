<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}" data-controller="html-load" dir="{{ \Orchid\Support\Locale::currentDir() }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>
        @yield('title', config('app.name'))
        @hasSection('title')
            - {{ config('app.name') }}
        @endif
    </title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf_token" content="{{  csrf_token() }}" id="csrf_token">
    <meta name="auth" content="{{  Auth::check() }}" id="auth">
    @if(\Orchid\Support\Locale::currentDir(app()->getLocale()) == "rtl")
        <link rel="stylesheet" type="text/css" href="{{  mix('/css/orchid.rtl.css','vendor/orchid') }}">
    @else
        <link rel="apple-touch-icon" sizes="57x57" href="/core_ui/assets/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/core_ui/assets/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/core_ui/assets/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/core_ui/assets/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/core_ui/assets/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/core_ui/assets/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/core_ui/assets/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/core_ui/assets/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/core_ui/assets/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/core_ui/assets/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/core_ui/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/core_ui/assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/core_ui/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="/core_ui/assets/favicon/manifest.json">
        <link rel="stylesheet" href="/core_ui/vendors/simplebar/css/simplebar.css">
        <link rel="stylesheet" href="/core_ui/css/vendors/simplebar.css">
        <link href="/core_ui/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
        <link href="/core_ui/css/examples.css" rel="stylesheet">
        <link href="/core_ui/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
    @endif

    @stack('head')

    <meta name="turbo-root" content="{{  Dashboard::prefix() }}">
    <meta name="dashboard-prefix" content="{{  Dashboard::prefix() }}">

    @if(!config('platform.turbo.cache', false))
        <meta name="turbo-cache-control" content="no-cache">
    @endif

    <!--<script src="{{ mix('/js/manifest.js','vendor/orchid') }}" type="text/javascript"></script>
    <script src="{{ mix('/js/vendor.js','vendor/orchid') }}" type="text/javascript"></script>
    <script src="{{ mix('/js/orchid.js','vendor/orchid') }}" type="text/javascript"></script>-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>

    @foreach(Dashboard::getResource('stylesheets') as $stylesheet)
        <link rel="stylesheet" href="{{  $stylesheet }}">
    @endforeach

    @stack('stylesheets')

    @foreach(Dashboard::getResource('scripts') as $scripts)
        <script src="{{  $scripts }}" defer type="text/javascript"></script>
    @endforeach

    @if(!empty(config('platform.vite', [])))
        @vite(config('platform.vite'))
    @endif
</head>

<body class="{{ \Orchid\Support\Names::getPageNameClass() }}" data-controller="pull-to-refresh">

<div data-controller="@yield('controller')" @yield('controller-data')>

        @yield('aside')

        <div class="container-lg">
            @yield('body')
        </div>
        
    </div>


    @include('platform::partials.toast')
</div>
<script src="/core_ui/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="/core_ui/vendors/simplebar/js/simplebar.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="/core_ui/vendors/chart.js/js/chart.min.js"></script>
<script src="/core_ui/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
<script src="/core_ui/vendors/@coreui/utils/js/coreui-utils.js"></script>
<script src="/core_ui/js/main.js"></script>

@stack('scripts')


</body>
</html>
