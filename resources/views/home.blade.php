@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col">
            <div class="jumbotron p-0" id="splash">
                <h1>Your Yacht<br>
                    Our Product</h1>
                <img src="{{ asset('storage/images/hero-01.jpg') }}" data-rjs="3" alt="Speedboat" class="w-100">
            </div>
        </div> {{--col--}}
    </div> {{--row--}}

    <div class="row">

        <div class="col-lg-8">
            <div class="rounded p-3 mb-4" id="main-content">

                <div id="welcome-aboard-special" class="col-12 article">
                    <h2>Welcome Aboard Special - $445*</h2>
                    <img src="{{ asset('storage/images/welcome-aboard-special-photo_01.jpg') }}" class="img-fluid promo-photo" data-rjs="3" alt="Welcome Aboard Special">
                    <p>A great way to sample our products at a savings!</p>
                    <h4>Here's what you'll get:</h4>
                    <p>100 each of our 8oz Foam Cups, our shatter resistant 10oz FrostFlex Tumblers, and 250 of our White Beverage Napkins. Order Another Welcome Aboard Special at the same time for your Office, Boat, Farm, Ranch, or Vacation Home and get <span class="font-weight-bold">10% off</span> the additional order!</p>
                    <div class="row">
                        <div class="col was-item"><img src="{{ asset('storage/images/welcome-aboard-assets/S8.png') }}" data-rjs="3" alt="Foam Cup">
                            <h4 class="mb-0">100</h4>
                            <p>8oz Foam Cups</p>
                        </div>
                        <div class="col was-item"><img src="{{ asset('storage/images/welcome-aboard-assets/N10.png') }}" data-rjs="3" alt="Beverage Napkin">
                            <h4 class="mb-0">250</h4>
                            <p>White Beverage Napkins</p>
                        </div>
                        <div class="col was-item"><img src="{{ asset('storage/images/welcome-aboard-assets/P10.png') }}" data-rjs="3" alt="Frost-Flex Cup">
                            <h4 class="mb-0">100</h4>
                            <p>10 oz Frost-Flex Tumblers</p>
                        </div>
                    </div>
                    <p class="aside">*One special per logo please. Price includes one flat price, unlimited colors, digitally printed.</p>
                </div>

{{--
                <div class="col-12 article" id="product-categories">
                    <h2>Product Categories:</h2>
                    <div class="gallery-wrapper row">

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="#" class="product-cat" id="napkins">
                                <figure class="figure">
                                    <img class="img-fluid"
                                         src="{{ asset('storage/images/product-categories-assets/napkins.png') }}"
                                         data-rjs="3" alt="Napkins">
                                </figure>
                                Napkins
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="#" class="product-cat" id="coasters">
                                <figure class="figure">
                                    <img class="img-fluid"
                                         src="{{ asset('storage/images/product-categories-assets/coasters.png') }}" data-rjs="3"
                                         alt="Coasters">
                                </figure>
                                Coasters
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="#" class="product-cat" id="stirpiks">
                                <figure class="figure">
                                    <img class="img-fluid"
                                         src="{{ asset('storage/images/product-categories-assets/stirpiks.png') }}" data-rjs="3"
                                         alt="Drink Stirrers, Food Piks, &amp; Ice Cream Spoons">
                                </figure>
                                Stirrers &amp; Piks
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="#" class="product-cat" id="plates">
                                <figure class="figure">
                                    <img class="img-fluid"
                                         src="{{ asset('storage/images/product-categories-assets/plates.png') }}"
                                         data-rjs="3" alt="Plates">
                                </figure>
                                Plates
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="#" class="product-cat" id="cups">
                                <figure class="figure">
                                    <img class="img-fluid"
                                         src="{{ asset('storage/images/product-categories-assets/cups.png') }}"
                                         data-rjs="3" alt="Cups">
                                </figure>
                                Cups
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="#" class="product-cat" id="utensils">
                                <figure class="figure">
                                    <img class="img-fluid"
                                         src="{{ asset('storage/images/product-categories-assets/utensils.png') }}" data-rjs="3"
                                         alt="Lids, Straws, &amp; Utensils">
                                </figure>
                                Lids &amp; Utensils
                            </a>
                        </div>

                    </div> <!-- .gallery-wrapper, .row -->
                </div> <!-- .article, #product-categories -->
--}}

            </div> {{--#main-content--}}
        </div> {{--col--}}

        <div class="col-lg-4">
            <div class="rounded p-3" id="sidebar">

                <div class="feature">
                    <h4>Personalization is the Key</h4>
                    <p>
                        As a professional mariner, you know that galley supplies add that &ldquo;Over the Top&rdquo; touch to your sailing operations. Whether it is owner-driven or a company ship, your yacht reflects the image of you and your company. Now it's time to make sure you personalize it, with custom imprinted Cups, Napkins, Plates, &amp; Coasters.<br>
                        <br>
                        Your personalized Drinkware is as easy as:</p>
                    <ol>
                        <li>Pick your yacht from our vast clipart library.</li>
                        <li>Provide text and/or ship name with chosen font.</li>
                        <li>Fill out our <a href="{{ asset('storage/ays_orderform.pdf') }}" title="Order Form" target="_blank">order form<i class="fas fa-download ml-1" aria-hidden="true"></i></a>.
                        </li>
                        <li>Approve your proof provided to you within 1 business day.</li>
                    </ol>
                </div> {{--feature--}}

                <div class="feature">
                    <h4>A Captain's Guide to Custom Imprinted Drinkware</h4>
                    <p>
                        As a professional mariner or business owner, have you ever tried to track down galley supplies for your yacht? You see them everywhere but no one seems to know where to get them, and when you find a source, it is 2&ndash;3 weeks before your product ships. This company represents the classic &ldquo;saw a need and filled it&rdquo; story. <a href="{{ route('about') }}" title="About Us" target="_self">More on our story&hellip;</a>
                    </p>
                </div> {{--feature--}}

                <div class="feature">
                    <h4>Downloadable 2013 Catalog</h4>
                    <a href="{{ asset('storage/American_Yacht_Supply_Catalog_2013_OPT.pdf') }}" target="_blank">
                        <img src="{{ asset('storage/images/ays_catalog_2013_cover_front.jpg') }}" data-rjs="3" alt="Downloadable Catalog" id="cat-cover">
                    </a>
                    <p>
                        Why wait for the mail? Get our digital catalog instantly and be eco-friendly. Browse through our many products to see which ones are right for you. If you can’t decide, call customer service and ask for a free random sample. We will gladly send you the actual item to see if it fits your cup holders as well as to see if you like the product.<br>
                        <br>
                        Download the catalog to refer to later on your laptop. 16 pages of top-of-the-line customizable drinkware items waiting for your yacht's picture and name.<br>
                        <br>
                        Created for captains, by captains. Happy Sailing!
                    </p>
                </div> {{--feature--}}

            </div> {{--#sidebar--}}
        </div> {{--col--}}

    </div> {{--row--}}

@endsection
