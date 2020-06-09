@extends('layouts.app')


@section('content')

    <?php
    $showSidebar = !empty($productFeatures) || !empty($productNotes);
    $imageContentClasses = 'col-12';
    $splashImageClass = 'px-3';
    if ($showSidebar) {
        $imageContentClasses = 'col-md-8 col-lg-9';
        $splashImageClass .= ' pl-md-0 pr-md-3';
    }
    if (isset($productLine)) {
        $methodColor = '#' . $productLine->printMethod->hex;
    }
    ?>


    <div id="product-content" class="p-3">

        <div class="row">
            <div class="col">
                <div id="title" class="text-center text-md-left">
                    <h1 class="is-accented">{{ $productLine->productSubcategory->long_name }}
                    @if (!is_null($productLine->productSubcategory->subhead))
                        | <small>{{ $productLine->productSubcategory->subhead }}</small>
                    @endif
                    </h1>
                </div>
            </div>
        </div> {{--Title--}}

        <div class="row">
            <div class="{{ $imageContentClasses }} order-md-last my-3">
                <div id="images-content">
                    <div id="splash-image">
                        <img src='{{ asset("storage/images/product-subcategories-assets/{$productLineText}.png") }}'
                             alt="{{ $productLineText }}" class="img-fluid mx-auto d-block" data-rjs="3">
                    </div>
                </div>
            </div>

            @if($showSidebar)
            <div class="col-md-4 col-lg-3 order-md-first my-3">
                <div id="fo-column">
                    @if(!empty($productFeatures))
                    <div id="features-options">
                        <h2 style="color: {{ $methodColor }};">{{ $productLine->printMethod->long_name }}</h2>
                        <h2>Features &amp; Options</h2>
                        {!! $productFeatures !!}
                    </div>
                    @endif
                    @if(!empty($productNotes))
                    <div id="text-notes">
                        {!! $productNotes !!}
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div> {{--Features, Options, and Splash Image--}}

        <div id="prices-content" class="row mb-5">
            {!! $productCards !!}
        </div> {{--Prices--}}

        @if(!empty($swatchesProduct) || !empty($swatchesImprintColor) || !empty($swatchesImprintType))
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="swatch-tabs" role="tablist">

                    @if(!empty($swatchesProduct))
                    <li class="nav-item swatches__title">
                        <a class="swatches__tab__link nav-link" id="swatches__product-color__tab" data-toggle="tab" href="#swatches__product-color" role="tab" aria-controls="swatches__product-color" aria-selected="false">Product Color Choices</a>
                    </li>
                    @endif

                    @if(!empty($swatchesImprintColor))
                    <li class="nav-item swatches__title">
                        <a class="swatches__tab__link nav-link" id="swatches__imprint-color__tab" data-toggle="tab" href="#swatches__imprint-color" role="tab" aria-controls="swatches__imprint-color" aria-selected="false">Imprint Color Choices</a>
                    </li>
                    @endif

                    @if(!empty($swatchesImprintType))
                    <li class="nav-item swatches__title">
                        <a class="swatches__tab__link nav-link" id="swatches__imprint-type__tab" data-toggle="tab" href="#swatches__imprint-type" role="tab" aria-controls="swatches__imprint-type" aria-selected="false">Imprint Type Choices</a>
                    </li>
                    @endif

                </ul>
                <div class="tab-content" id="swatch-tabs-content">

                    @if(!empty($swatchesProduct))
                    <div class="tab-pane fade swatches__content" id="swatches__product-color"
                         role="tabpanel" aria-labelledby="swatches__product-color__tab">
                        {!! $swatchesProduct !!}
                    </div>
                    @endif

                    @if(!empty($swatchesImprintColor))
                    <div class="tab-pane fade swatches__content" id="swatches__imprint-color"
                         role="tabpanel" aria-labelledby="swatches__imprint-color__tab">
                        {!! $swatchesImprintColor !!}
                    </div>
                    @endif

                    @if(!empty($swatchesImprintType))
                    <div class="tab-pane fade swatches__content" id="swatches__imprint-type"
                         role="tabpanel" aria-labelledby="swatches__imprint-type__tab">
                        {!! $swatchesImprintType !!}
                    </div>
                    @endif

                </div>
            </div>
        </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jquery-infinite-rotator/js/infinite-rotator.js') }}"></script>
    <script type="text/javascript">

        $(function() {

          // Show the first tab in the swatches area.
          $(".swatches__tab__link").first().addClass("active").attr("aria-selected", "true");
          $(".tab-pane").first().addClass("show active");

          // Set a .rollover class for _only_ those individual product images that _have_ a "Sample" version.
          $(".thumbnail__image--blank").each(function() {
            $(this)
              .parents(".thumbnail__overlay")
              .addClass("thumbnail__overlay--rollover");
          });

          // Toggle the "Sample" image for the individual product images.
          $(".thumbnail__overlay").hover(function() {
            $(this).find(".thumbnail__image.thumbnail__image--blank").toggle();
            $(this).find(".thumbnail__image.thumbnail__image--sample").toggle();
          });

          // Make `singleton`s centered and a bit wider than normal.
          $(".singleton")
            .parent().removeClass("col-xl-6").addClass("col-md-8")
            .parent().addClass("justify-content-center");

        });

    </script>
@endpush
