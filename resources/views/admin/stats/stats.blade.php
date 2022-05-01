@extends('layouts.frontend')

@section('title')
    <title>
        Dashboard - Statistiques</title>
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

        h1 {
            margin-top: 10px;
            font-size: 40px;
            font-weight: 500;
            color: #555;
            line-height: 50px;
        }

        h2 {
            margin-top: 10px;
            font-size: 30px;
            font-weight: 500;
            color: #555;
            line-height: 50px;
        }

        h3 {
            font-size: 22px;
            font-weight: 500;
            color: #555;
            line-height: 30px;
        }

        h4 {
            font-size: 18px;
            font-weight: 450;
            color: rgb(255, 255, 255);
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

        .table caption {
            caption-side: top;
            text-align: center;
            font-weight: 500;
            border-radius: 3px 3px 0 0;
            color: #fff;
        }

        .dash-table {
            text-align: left;
            white-space: nowrap;
        }

        table {
            border-collapse: collapse;
        }

    </style>
@endsection

@section('content')
    <div class="container pt-10">
        <div class="row mb-4">
            <div class="col-md">
                <h1><i class="fas fa-chart-bar mr-2"></i>Statistiques</h1>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12 col-lg-6">
                <div class="row">
                    <div class="col-md-6 my-3">
                        <div class="card" style="background-color: rgba(254, 119, 123, 0.9)">
                            <div class="card-body">

                                <div class="row mb-4">
                                    <h3 class="text-light"><i class="fa-solid fa-dollar-sign mr-2 "></i>
                                        Revenu ({{ $currency }})
                                    </h3>
                                </div>
                                <div class="row mb-3">
                                    <h1 class="mx-auto text-light"><b>
                                            @if (isset($earnings) && isset($currency))
                                                {{ $earnings }}
                                            @endif
                                        </b></h1>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <h3 class="text-secondary"><i class="fa-solid fa-cart-shopping mr-2"></i> Ventes </h3>
                                </div>
                                <div class="row mb-3">
                                    <h2 class="mx-auto"><b>
                                            @if (isset($total_sales))
                                                {{ $total_sales }}
                                            @endif
                                        </b></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <h3 class="text-secondary">
                                        <i class="fa-solid fa-box mr-2"></i> Livré
                                    </h3>
                                </div>
                                <div class="row mb-3">
                                    <h2 class="mx-auto"><b>
                                            @if (isset($delivered))
                                                {{ $delivered }}
                                            @endif
                                        </b></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <h3 class="text-secondary">
                                        <i class="fa-solid fa-xmark mr-2"></i> Annulé
                                    </h3>
                                </div>
                                <div class="row mb-3">
                                    <h2 class="mx-auto"><b>
                                            @if (isset($canceled))
                                                {{ $canceled }}
                                            @endif
                                        </b></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-lg-6">
                <my-chart />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card px-0">
                    <div class="card-body">
                        <h3 class="mb-4">Statistiques de ventes:</h3>
                        <ul class="list-group dashboard-list">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong style="color:#203656"> Aujourd'hui : </strong><span
                                    class="badge badge-success badge-pill">
                                    @if (isset($today_sales))
                                        {{ $today_sales }}
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong style="color:#203656"> Hier : </strong><span class="badge badge-success badge-pill">
                                    @if (isset($yesterday_sales))
                                        {{ $yesterday_sales }}
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong style="color:#203656"> Cette semaine : </strong><span
                                    class="badge badge-success badge-pill">
                                    @if (isset($week_sales))
                                        {{ $week_sales }}
                                    @endif

                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong style="color:#203656"> Ce mois-ci : </strong> <span
                                    class="badge badge-success badge-pill">
                                    @if (isset($month_sales))
                                        {{ $month_sales }}
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong style="color:#203656"> Cette année :</strong> <span
                                    class="badge badge-success badge-pill">
                                    @if (isset($year_sales))
                                        {{ $year_sales }}
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong style="color:#203656"> Tout le temps : </strong><span
                                    class="badge badge-success badge-pill">
                                    @if (isset($total_sales))
                                        {{ $total_sales }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">

                <latest-sales-table></latest-sales-table>
                <latest-products-table></latest-products-table>

            </div>
        </div>
    @endsection


    @section('scripts')
    @endsection
