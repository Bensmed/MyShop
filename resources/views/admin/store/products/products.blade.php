@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Produits</title>
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
                <h1><i class="fa-brands fa-product-hunt mr-2"></i>Liste des produits:</h1>
            </div>
            <div class="col-md-2 my-auto">
                <a class="btn btn-danger" href="{{ url('/admin/produits/ajouter') }}"><i
                        class="fas fa-plus mr-1"></i><strong>Nouveau
                        produit</strong></a>
            </div>

        </div>

        <div class="card">
            <table class=" table table-hover" style="background-color: white;color: #1E1E1E;">
                <thead style="background-color: rgba(253, 120, 101, 0.7)">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Solde</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($products) && isset($currency))
                        @foreach ($products as $product)
                            <tr is="product-row" product-id={{ $product->id }} product-name='{{ $product->name }}'
                                product-slug='{{ $product->slug }}' product-price={{ $product->price }}
                                product-sale-price='{{ $product->sale_price }}' on-sale='{{ $product->on_sale }}'
                                product-category='{{ $product->category_name }}' in-stock='{{ $product->in_stock }}'
                                store-currency='{{ $currency }}'>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            @if (isset($products) && isset($currency))
                @php
                    if ($products->url($products->currentPage()) == $products->url(1)) {
                        $isFirstPage = true;
                    } else {
                        $isFirstPage = false;
                    }

                    if ($products->url($products->currentPage()) == $products->url($products->lastPage())) {
                        $isLastPage = true;
                    } else {
                        $isLastPage = false;
                    }

                @endphp

                <ul class="pagination text-center mx-auto">

                    <li @class(['page-item', 'disabled' => $isFirstPage])><a class="page-link"
                            href="{{ $products->previousPageUrl() }}">Précédent</a></li>

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        @php
                            if ($products->currentPage() == $i) {
                                $isActive = true;
                            } else {
                                $isActive = false;
                            }
                        @endphp
                        <li @class(['page-item', 'active' => $isActive])><a class="page-link"
                                href="{{ $products->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    <li @class(['page-item', 'disabled' => $isLastPage])>

                        <a class="page-link" href="{{ $products->nextPageUrl() }}">Suivant</a>
                    </li>

                </ul>
            @endif
        </div>
    </div>
@endsection


@section(' scripts')
@endsection
