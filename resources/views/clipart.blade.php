@extends('layouts.app')


@section('content')

    <div id="general-content" class="p-3">

        @component('partials.general-content__title', ['title' => 'Clip Art'])
            <h3 class="clipart__subtitle d-inline-block px-4 py-1">{{ $clipartSubcategory->long_name }}</h3>
        @endcomponent

        <div class="row clipart__info m-2 m-md-4">

            <div class="col-12 clipart__intro">
                <img src="{{ asset('storage/images/clipart/clipart-sketch-' . $clipartSubcategory->clipartCategory->id . '.svg') }}" alt="Sample Sketch"
                     class="clipart__sample-sketch col-12 col-md-4 p-0 float-left mr-3 mb-2">
                <div class="clipart__instructions">
                    @if($clipartSubcategory->clipartCategory->id === 'aircraft')
                        <img src="{{ asset('storage/images/clipart/clipart-combination-sample.svg') }}" alt="Plane On Clouds"
                             class="clipart__sample-combo col-6 col-md-3 col-lg-2 p-0 float-right ml-3 mb-2">
                    @endif
                    <p>To create a design using our clip art and typestyles, sketch the layout of the design and label the parts like the example to the right. Use additional pages if necessary. If a different design is to be used on different items, use as many sketches as necessary and label each for the particular item upon which it is to be used. We will size the art to the item to be imprinted. If you have particular size requirements, we will follow your specifications. Should you need a line drawing that is not here, call, and if we don’t have what you need, we can probably create it for you.</p>
                </div>
            </div> {{--.clipart__intro--}}

            <div class="col-12 clipart__gallery d-flex flex-wrap">
                @if(count($images) > 0)
                    @foreach($images as $image)
                        @php
                            $filenameArray = explode('.', $image);
                            $filename = array_shift($filenameArray);
                        @endphp
                        <div class="clipart__thumb col-12 col-sm-6 col-md-3 col-xl-2">
                            <figure class="img-thumbnail position-relative mb-1" style="background: #fff url('{{ asset('storage/images/clipart/' . $clipartSubcategory->id . '/' . $image) }}') center center no-repeat; -webkit-background-size: 95% 95%; background-size: 95% 95%;">
                                {{--<img src="{{ asset('storage/images/clipart/' . $clipartSubcategory->id . '/' . $image) }}" alt="{{ $filename }}" class="thumbnail__img position-absolute">--}}
                            </figure>
                            <p class="clipart__caption">{{ $filename }}</p>
                        </div>
                    @endforeach
                @endif
            </div> {{--.clipart__gallery--}}

        </div> {{--.clipart__info--}}


    </div> {{--#general-content--}}

@endsection
