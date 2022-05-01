@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Sliders</title>
@endsection

@section('styles')
    <style>
        body {
            font-size: 16px;
            font-weight: 300;
            color: #888;

        }

        h1 {
            font-size: 40px;
            font-weight: 500;
            color: #555;

        }



        /***** Custom css *****/

        .card {

            box-shadow: 0 2px 4px rgba(204, 204, 204, 0.8);
            padding: 20px 40px;
            border-radius: 5px;
        }

    </style>
@endsection

@section('content')
    <div class="container pt-10">

        <div class="row mb-5">
            <div class="col-md-10">
                <h1><i class="fa-solid fa-film mr-2"></i>Gérer les Sliders:</h1>
            </div>
            <div class="col-md-2 my-auto">
                <a class="btn btn-danger" href="{{ url('/admin/sliders/ajouter') }}"><i
                        class="fas fa-plus mr-1"></i><strong>Nouveau
                        Slider</strong></a>
            </div>

        </div>
        @if (isset($sliders))
            @if (sizeof($sliders) != 0)
                <section id="home" class="slider-area">
                    @foreach ($sliders as $slider)
                        <slider :slider='{{ json_encode($slider) }}'></slider>
                    @endforeach
                </section>
            @else
                <div class="mt-5 w-100 text-center" id="noSliderAlert">
                    <div class="alert alert-warning py-4">Aucun Slider.</div>
                </div>
            @endif

        @endif


    </div>
@endsection


@section(' scripts')
@endsection
