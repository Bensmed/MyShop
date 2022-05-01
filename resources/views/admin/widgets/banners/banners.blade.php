@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Banners</title>
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

        @media only screen and (min-width: 1400px) {
            .slider-social {
                padding: 0 0px;
            }
        }

    </style>
@endsection

@section('content')
    <div class="container pt-10">

        <div class="row mb-5">
            <div class="col-md-10">
                <h1><i class="fas fa-image mr-2"></i>Gérer les Banners:</h1>
            </div>
            <div class="col-md-2 my-auto">
                <a class="btn btn-danger" href="{{ url('/admin/banner/ajouter') }}"><i
                        class="fas fa-plus mr-1"></i><strong>Nouveau
                        Banner</strong></a>
            </div>

        </div>
        @if (isset($banners))
            @if (sizeof($banners) != 0)
                <section id="discount-product" class="discount-product">
                    <div class="container">
                        <div class="row">

                            @foreach ($banners as $banner)
                                <banner :banner='{{ json_encode($banner) }}'></banner>
                            @endforeach
                        </div> <!-- row -->
                    </div> <!-- container -->
                </section>
            @else
                <div class="mt-5 w-100 text-center" id="noSliderAlert">
                    <div class="alert alert-warning py-4">Aucun Banner.</div>
                </div>
            @endif

        @endif


    </div>
@endsection


@section(' scripts')
@endsection
