@extends('layouts.app')


@section('content')

    <div id="general-content" class="p-3">

        @component('partials.general-content__title', ['title' => 'Typefaces'])
        @endcomponent

        <div class="row typefaces__info m-2 m-md-4">
            @if(count($typefaces) > 0)
                <div class="col-12 typefaces__gallery row">
                    @foreach($typefaces as $typeface)
                        @php
                            $filenameArray = explode('.', $typeface);
                            $filenameUnderscored = array_shift($filenameArray);
                            $filename = str_replace('_', ' ', $filenameUnderscored);
                        @endphp
                        <div class="typefaces__typeface col-12 col-md-6 mb-5">
                            <h5 class="typefaces__name">{{ $filename }}</h5>
                            <img src="{{ asset('storage/images/fonts/' . $typeface) }}" alt="{{ $filename }}" class="svg">
                        </div>
                    @endforeach
                </div> {{--.typefaces__gallery--}}
            @endif

        </div> {{--.typefaces__info--}}


    </div> {{--#general-content--}}

@endsection
