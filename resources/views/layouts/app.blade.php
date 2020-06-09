<!doctype html>
<html lang="en">
    <head>
        @include('partials.page_head')
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ setting('acs.google_analytics_tracking_id') }}"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @include('layouts.layout_main')

        <!-- Custom compiled scripts. -->
        <script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <!-- FlexiNav -->
        <script type="text/javascript" src="{{ asset('vendor/flexinav/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/flexinav/js/flexinav_plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/flexinav/js/flexinav.min.js') }}"></script>

        <!-- Miscellaneous scripts -->
        @stack('scripts')

    </body>
</html>
