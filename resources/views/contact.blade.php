@extends('layouts.app')


@section('content')

    <div id="general-content" class="p-3">

        @component('partials.general-content__title', ['title' => 'Contact Information'])
        @endcomponent

        <div class="row contact-info m-2 m-md-4 text-center">
            <div class="col-12">

                <p class="font-weight-bold is-accented m-0">American Cabin Supply</p>
                <p>390 Enterprise Drive<br>
                    Nicholasville, KY 40356</p>

                <p>Phone: (859) 887-1492<br>
                    Toll Free: (800) 932-9933<br>
                    24-Hour Fax Line: (859) 885-7891</p>

                <p>Hours: 8:30am &ndash; 5:00pm EST Mon.&ndash;Fri.</p>

                <p><a href="mailto:customerservice@americancabin.com">customerservice@americancabin.com</a></p>

            </div> {{--.col-12--}}
        </div> {{--.about-info--}}


    </div> {{--#general-content--}}

@endsection
