<div class="row">
    <div class="col">

        <nav>

            <div id="flexinav1" class="flexinav flexinav_ocean">
                <div class="flexinav_wrapper">
                    {{--<ul class="navbar-nav nav-fill w-100">--}}
                    <ul class="flexinav_menu">

                        <li class="flexinav_collapse">
                            <span><i class="fas fa-bars"></i>Navigation</span>
                        </li>

                        <!-- Products Menu -->
                        {!! $productsHtml !!}

                        <!-- Clipart Menu -->
                        {!! $clipartHtml !!}

                        <!-- Information Menu -->
                        <li><span>Information</span>
                            <div class="flexinav_ddown flexinav_ddown_fly_out flexinav_ddown_240">
                                <ul class="dropdown_flyout">
                                    <li><a href="{{ asset('storage/ays_orderform.pdf') }}" target="_blank" title="Order Form">Order Form</a></li>
                                    <li><a href="{{ route('typefaces') }}" target="_self" title="Fonts">Typefaces</a></li>
                                    <li><a href="{{ route('generalInfo') }}" target="_self" title="General Information">General Info</a></li>
                                    <li><a href="{{ route('about') }}" target="_self" title="About Us">About Us</a></li>
                                    <li><a href="{{ route('contact') }}" target="_self" title="Contact Information">Contact Info</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div> {{--.flexinav_wrapper--}}
            </div> {{--.flexinav, .flexinav_red--}}
        </nav>

    </div> {{--col--}}
</div> {{--row--}}

@push('scripts')
    <script>
        $(function ($) {
            $('#flexinav1').flexiNav({
                flexinav_effect: 'flexinav_hover',
                flexinav_show_duration: 300,
                flexinav_hide_duration: 200,
                flexinav_show_delay: 200,
                flexinav_trigger: true,
                flexinav_hide: false,
                flexinav_scrollbars: false,
                flexinav_scrollbars_height: 500,
                flexinav_responsive: true,
            });

            // Add the 'last' class to the last Subcategory of each Menu Category.
            // This adds a bit of space to the bottom of the Menu Category's flyout.
            $('.dropdown_flyout').children('li:last-child').addClass('last');
        })
    </script>
@endpush
