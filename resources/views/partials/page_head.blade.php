<!-- Google Tag Manager -->
<!--suppress EqualityComparisonWithCoercionJS, ES6ConvertVarToLetConst -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','{{ setting('acs.google_analytics_tracking_id') }}');</script>
<!-- End Google Tag Manager -->

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content={{ csrf_token() }}>

<title>{{ setting('site.title') }}</title>

{{-- FontAwesome --}}
<script src="https://kit.fontawesome.com/8055eacedd.js" crossorigin="anonymous"></script>

<!-- Favicons! -->
<link rel="apple-touch-icon-precomposed" href="{{ asset('storage/favicons/favicon-180.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('storage/favicons/favicon-152.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('storage/favicons/favicon-120.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('storage/favicons/favicon-76.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('storage/favicons/favicon-57.png') }}">
<link rel="mask-icon" href="{{ asset('storage/favicons/icon.svg') }}" color="#591315">
<link rel="shortcut icon" sizes="196x196" href="{{ asset('storage/favicons/favicon-196.png') }}">

<link rel="icon" href="{{ asset('storage/favicons/favicon-228.png') }}" sizes="228x228">
<link rel="icon" href="{{ asset('storage/favicons/favicon-195.png') }}" sizes="195x195">
<link rel="icon" href="{{ asset('storage/favicons/favicon-144.png') }}" sizes="144x144">
<link rel="icon" href="{{ asset('storage/favicons/favicon-128.png') }}" sizes="128x128">
<link rel="icon" href="{{ asset('storage/favicons/favicon-96.png') }}" sizes="96x96">
<link rel="icon" href="{{ asset('storage/favicons/favicon-32.png') }}" sizes="32x32">

<meta name="msapplication-TileColor" content="#591315">
<meta name="msapplication-TileImage" content="{{ asset('storage/favicons/favicon-144.png') }}">
<meta name="application-name" content="{{ setting('acs.site_title') }}">
<meta name="msapplication-tooltip" content="{{ setting('acs.site_title') }}">
<meta name="msapplication-config" content="{{ asset('storage/favicons/ieconfig.xml') }}">
<!-- End Favicons -->

<!-- TypeKit -->
<link rel="stylesheet" href="https://use.typekit.net/iky4qsm.css">

<!-- FlexiNav -->
<link rel="stylesheet" href="{{ asset('vendor/flexinav/css/flexinav.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/flexinav/css/scrollbars.css') }}">

<!-- Main Styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

@stack('styles')
