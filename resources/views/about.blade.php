@extends('layouts.app')


@section('content')

    <div id="general-content" class="p-3">

        @component('partials.general-content__title', ['title' => 'Our Story'])
        @endcomponent

        <div class="row about-info m-2 m-md-4">
            <div class="col-12">

                <img src="{{ asset('storage/images/plane_N21T_onground.jpg') }}" alt="N21T plane on ground" class="accent-image float-right m-2" id="about-image">

                <p class="font-weight-bold">Dear Captain,</p>

                <p>As a professional mariner or business owner, have you ever tried to track down galley supplies for your yacht? You see them everywhere but no one seems to know where to get them, and when you find a source, it is 2&ndash;3 weeks before your product ships. This company represents the classic &ldquo;saw a need and filled it&rdquo; story.</p>

                <p>The year was 1985. My father was a corporate pilot and saw the need for a mail order catalog of custom imprinted galley supplies that a discerning customer like yourself could simply pick up the phone and order. So out of our basement in a little town called Nicholasville, Kentucky, my parents created a catalog and set up a print operation. After 10 years of great success in the aviation industry, we branched out and created American Yacht Supply.</p>

                <p>Today, {{ date("Y") - 1985 }} years later, {{ setting('ays.site_title') }} is a bit bigger, a bit more diverse, but in many ways still the same. We&rsquo;re still in the same small Kentucky town. We&rsquo;re still on the vanguard of the drinkware business. And most important, we still thrive on the quality and service that my parents instilled upon the company. Our skilled craftsmen pride themselves on producing a quality product, within a 5 day turnaround time, that will appeal to our discerning customer, and is backed by the best guarantee available anywhere.</p>

                <img src="{{ asset('storage/images/signature-ShawnClaggett-black.png') }}" alt="Shawn Claggett" class="signature">

                <p class="font-weight-bold">Shawn Claggett<br>
                    President, 2nd Generation</p>

            </div> {{--.col-12--}}
        </div> {{--.about-info--}}


    </div> {{--#general-content--}}

@endsection
