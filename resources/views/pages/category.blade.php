@extends('layouts.frontend')

@section('title')
    @if (isset($category))
        <title>{{ $category['name'] }}</title>
    @endif
@endsection

@section('content')
    <section id='category'>
        @if (isset($category) && isset($products) && isset($categories))
            <section class="products-page" style="margin-top: 100px;">
                <div class="container" style="margin-bottom: 50px">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">{{ $category['name'] }}</li>
                        </ul>
                    </nav>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="side-bar-content">
                                <h4>Catégories</h4>
                                <ul class="sidebar-menu">
                                    @foreach ($categories as $cat)
                                        <li><a
                                                href="/categorie/{{ $cat->id }}/{{ $cat->slug }}">{{ $cat->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- <div class="side-bar-content">
                                                                                                                                                                                                                                                                                                                                                                                                            <h4>Keywords</h4>
                                                                                                                                                                                                                                                                                                                                                                                                            <div class="sidebar-tags">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a href=""></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                        </div> -->
                        </div>
                        <div class="col-md-9">
                            {{-- <div class="products-top-options">
                                <form>
                                    <select class="form-control" name="sortBy">
                                        <option value="" selected disabled>Trier les produits</option>
                                        <option value="asc">Croissant</option>
                                        <option value="desc">Descendant</option>
                                        <option value="lowprice">Prix bas</option>
                                        <option value="highprice">Prix élevé</option>
                                    </select>
                                </form>
                            </div> --}}

                            <div class="cat-products-gallery">
                                <div class="row">
                                    @if (sizeof($products) != 0)
                                        @foreach ($products as $product)
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="card">
                                                    <div class="product-img">
                                                        <a href="/produit/{{ $product['id'] }}/{{ $product['slug'] }}"
                                                            class=" w-100">
                                                            <img src="{{ URL::asset('images/products/' . $product['image_name']) }}"
                                                                class="card-img-top p-img " alt="" height="300px">
                                                        </a>
                                                        {{-- <div class="floating-buttons">
                                                            <form action="https://codma.ma/demo/card" method="post"
                                                                id="card-form1">
                                                                <input type="hidden" name="_token"
                                                                    value="sAgw2Kj6W5Q5OSyxi6uhNjKJJViip6DvSIPxDdCO"> <input
                                                                    type="hidden" name="p_id" value="1">
                                                            </form>
                                                            <form action="https://codma.ma/demo/wishlist" method="post"
                                                                id="wishlist-form1">
                                                                <input type="hidden" name="_token"
                                                                    value="sAgw2Kj6W5Q5OSyxi6uhNjKJJViip6DvSIPxDdCO"> <input
                                                                    type="hidden" name="p_id" value="1">
                                                            </form>
                                                            <button type="submit" form="wishlist-form1"><i
                                                                    class="bx bx-cart"></i></button>
                                                            <button type="submit" form="card-form1"><i
                                                                    class="bx bx-heart"></i></button>
                                                        </div> --}}
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <a
                                                                href="/produit/{{ $product['id'] }}/{{ $product['slug'] }}">{{ $product['name'] }}</a>
                                                        </h5>
                                                        <div class="prices">
                                                            @if ($product['on_sale'])
                                                                <p class="current-price">
                                                                    {{ $product['sale_price'] }} DZD
                                                                </p>
                                                                <p class="old-price">
                                                                    {{ $product['price'] }} DZD
                                                                </p>
                                                            @else
                                                                <p class="current-price">
                                                                    {{ $product['price'] }} DZD
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="mt-3 w-100 text-center" id="noProductAlert">
                                            <div class="alert alert-warning py-4">Aucun produit.</div>
                                        </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </section>
@endsection
