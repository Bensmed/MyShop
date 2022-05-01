@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Nouveau Produit</title>
@endsection

@section('styles')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: #888;

        }

        strong {
            font-weight: 550;
        }

        h1,
        h2 {
            margin-top: 10px;
            font-size: 40px;
            font-weight: 500;
            color: #555;
            line-height: 50px;
        }

        h3 {
            font-size: 22px;
            font-weight: 300;
            color: #555;
            line-height: 30px;
        }

        h4 {
            font-size: 18px;
            font-weight: 300;
            color: #555;
            line-height: 26px;
        }

        img {
            max-width: 100%;
        }

        .medium-paragraph {
            font-size: 18px;
            line-height: 34px;
        }

        ::-moz-selection {
            background: #f35b3f;
            color: #fff;
            text-shadow: none;
        }

        ::selection {
            background: #f35b3f;
            color: #fff;
            text-shadow: none;
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
            @if (isset($product) && isset($categories))
                <h1>Modifier un produit:</h1>
            @else
                <h1>Nouveau produit:</h1>
            @endif
        </div>

        @if (isset($product) && isset($categories))
            <new-product :all-categories='{{ json_encode($categories) }}' :edit-product='{{ json_encode($product) }}' />
        @else
            <new-product :all-categories='{{ json_encode($categories) }}' edit-product='new' />
        @endif


    </div>
@endsection


@section(' scripts')
@endsection
