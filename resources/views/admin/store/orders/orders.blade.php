@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Ventes</title>
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

        .dash-table {
            text-align: left;
            white-space: nowrap;
        }

    </style>
@endsection

@section('content')
    <div class="container pt-10">
        <div class="row mb-4">
            <h1><i class="fa-solid fa-cart-shopping mr-2"></i>Liste des ventes:</h1>
        </div>

        <div class="card">
            <table class=" table table-hover dash-table" style="background-color: white;color: #1E1E1E; ">
                <thead style="background-color: rgba(253, 120, 101, 0.7)">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Wilaya</th>
                        <th scope="col">Commune</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Prix total</th>
                        <th scope="col">Ordre(s)</th>
                        <th scope="col">Statut</th>
                        {{-- <th scope="col">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (isset($orders) && isset($currency))
                        @foreach ($orders as $order)
                            <tr is="order-row" :order='{{ json_encode($order) }}' store-currency='{{ $currency }}'>
                            </tr>
                        @endforeach

                </tbody>
            </table>

            @php
                if ($orders->url($orders->currentPage()) == $orders->url(1)) {
                    $isFirstPage = true;
                } else {
                    $isFirstPage = false;
                }

                if ($orders->url($orders->currentPage()) == $orders->url($orders->lastPage())) {
                    $isLastPage = true;
                } else {
                    $isLastPage = false;
                }

            @endphp

            <ul class="pagination text-center mx-auto">

                <li @class(['page-item', 'disabled' => $isFirstPage])><a class="page-link"
                        href="{{ $orders->previousPageUrl() }}">Précédent</a></li>

                @for ($i = 1; $i <= $orders->lastPage(); $i++)
                    @php
                        if ($orders->currentPage() == $i) {
                            $isActive = true;
                        } else {
                            $isActive = false;
                        }
                    @endphp
                    <li @class(['page-item', 'active' => $isActive])><a class="page-link"
                            href="{{ $orders->url($i) }}">{{ $i }}</a></li>
                @endfor

                <li @class(['page-item', 'disabled' => $isLastPage])>

                    <a class="page-link" href="{{ $orders->nextPageUrl() }}">Suivant</a>
                </li>

            </ul>
            @endif
        </div>

        @if (isset($orders) && isset($currency))
            @foreach ($orders as $order)
                <orders-modal order-id={{ $order->id }} :orders-details='{{ $order->order_details }}'
                    store-currency='{{ $currency }}'>
                </orders-modal>
            @endforeach
        @endif
    </div>
@endsection


@section(' scripts')
@endsection
