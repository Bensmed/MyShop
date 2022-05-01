@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Coupons</title>
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
        <div class="row mb-4">
            <div class="col-md-10">
                <h1><i class="fa fa-gift mr-2"></i>Liste des coupons:</h1>
            </div>
            <div class="col-md-2 my-auto">
                <a class="btn btn-danger" href="{{ url('/admin/coupons/ajouter') }}"><i
                        class="fas fa-plus mr-1"></i><strong>Nouveau
                        coupon</strong></a>
            </div>

        </div>

        <div class="card">
            <table class=" table table-hover" style="background-color: white;color: #1E1E1E;">
                <thead style="background-color: rgba(253, 120, 101, 0.7)">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Code</th>
                        <th scope="col">Type</th>
                        <th scope="col">Valeur</th>
                        <th scope="col">Utilisé</th>
                        <th scope="col">Max d'utilisation</th>
                        <th scope="col">Expiration</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @if (isset($coupons))
                        @foreach ($coupons as $coupon)
                            <tr is="coupon-row" :coupon='{{ json_encode($coupon) }}'>
                            </tr>
                        @endforeach

                </tbody>
            </table>

            @php
                if ($coupons->url($coupons->currentPage()) == $coupons->url(1)) {
                    $isFirstPage = true;
                } else {
                    $isFirstPage = false;
                }

                if ($coupons->url($coupons->currentPage()) == $coupons->url($coupons->lastPage())) {
                    $isLastPage = true;
                } else {
                    $isLastPage = false;
                }

            @endphp

            <ul class="pagination text-center mx-auto">

                <li @class(['page-item', 'disabled' => $isFirstPage])><a class="page-link"
                        href="{{ $coupons->previousPageUrl() }}">Précédent</a></li>

                @for ($i = 1; $i <= $coupons->lastPage(); $i++)
                    @php
                        if ($coupons->currentPage() == $i) {
                            $isActive = true;
                        } else {
                            $isActive = false;
                        }
                    @endphp
                    <li @class(['page-item', 'active' => $isActive])><a class="page-link"
                            href="{{ $coupons->url($i) }}">{{ $i }}</a></li>
                @endfor

                <li @class(['page-item', 'disabled' => $isLastPage])>

                    <a class="page-link" href="{{ $coupons->nextPageUrl() }}">Suivant</a>
                </li>

            </ul>
            @endif
        </div>
    </div>
@endsection


@section(' scripts')
@endsection
