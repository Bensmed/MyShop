@extends('layouts.frontend')

@section('styles')
@endsection


@section('content')
    <!--====== SLIDER PART START ======-->
    @if (isset($sliders))
        <section id="home" class="slider-area pt-20">
            <div class="container-fluid position-relative">
                <div class="slider-active">

                    @foreach ($sliders as $slider)
                        <div class="single-slider">
                            <div class="slider-bg">
                                <div class="row no-gutters align-items-center ">
                                    <div class="col-lg-4 col-md-5">
                                        <div class="slider-product-image d-none d-md-block">
                                            <img src="/images/sliders/{{ $slider->image_name }}" alt="Slider">
                                            <div class="slider-discount-tag">
                                                <p>{{ $slider->badge }}</p>
                                            </div>
                                        </div> <!-- slider product image -->
                                    </div>
                                    <div class="col-lg-8 col-md-7">
                                        <div class="slider-product-content">
                                            <h1 class="slider-title mb-10" data-animation="fadeInUp" data-delay="0.3s">
                                                <span>{{ $slider->title }}</span>
                                            </h1>
                                            <p class="mb-25" data-animation="fadeInUp" data-delay="0.9s">
                                                {{ $slider->paragraph }}</p>
                                            <a class="main-btn" href="/{{ $slider->link }}"
                                                data-animation="fadeInUp" data-delay="1.5s">{{ $slider->button }} <i
                                                    class="lni-chevron-right"></i></a>
                                        </div> <!-- slider product content -->
                                    </div>
                                </div> <!-- row -->
                            </div> <!-- container -->
                        </div> <!-- single slider -->
                    @endforeach



                </div> <!-- slider active -->
                {{-- <div class="slider-social">
                <div class="row justify-content-end">
                    <div class="col-lg-7 col-md-6">
                        <ul class="social text-right">
                            <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                            <li><a href="#"><i class="lni-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            </div> <!-- container fluid -->
        </section>
    @endif
    <!--====== SLIDER PART ENDS ======-->

    <!--====== DISCOUNT PRODUCT PART START ======-->
    @if (isset($banners))
        <section id="discount-product" class="discount-product pt-50">
            <div class="container">
                <div class="row">
                    @foreach ($banners as $banner)
                        <div class="col-lg-6">
                            <div class="single-discount-product mt-30">
                                <div class="product-image">
                                    <img src="/images/banners/{{ $banner->image_name }}" alt="Banner">
                                </div> <!-- product image -->
                                <div class="product-content">
                                    <h4 @class([
                                        'content-title',
                                        'mb-15',
                                        'text-light' => $banner->type == 'light',
                                    ])>{{ $banner->title }} <br>
                                        {{ $banner->paragraph }}
                                    </h4>
                                    <a href="/{{ $banner->link }}" @class(['text-light' => $banner->type == 'light'])>{{ $banner->button }}
                                        <i class="lni-chevron-right"></i></a>

                                </div> <!-- product content -->
                            </div> <!-- single discount product -->
                        </div>
                    @endforeach

                </div> <!-- row -->
            </div> <!-- container -->
        </section>
    @endif
    <!--====== DISCOUNT PRODUCT PART ENDS ======-->

    <!--====== PRODUCT PART START ======-->

    <section id="product" class="product-area pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="collection-menu text-center mt-30">
                        <h4 class="collection-tilte">Catégories</h4>
                        <div class="nav flex-column nav-pills" id="cat-tab" role="tablist" aria-orientation="vertical">
                            @if (isset($products_by_category))
                                @php
                                    $i = 0;
                                    $previous_cat = 0;
                                @endphp

                                @foreach ($products_by_category as $category => $products)
                                    @if ($previous_cat != $category)
                                        @php
                                            $previous_cat = $category;
                                            $i++;
                                        @endphp
                                        <a {{ $i == 1 ? 'class=active' : '' }} id="Cat{{ $category }}-tab"
                                            data-toggle="pill" href="#Cat{{ $category }}" role="tab"
                                            aria-controls="Cat{{ $category }}"
                                            aria-selected={{ $i == 1 ? 'true' : 'false' }}>{{ array_values($products)[0]['category'] }}</a>
                                    @endif
                                @endforeach
                            @endif


                        </div> <!-- nav -->
                    </div> <!-- collection menu -->
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="cat-tabContent">

                        @if (isset($products_by_category))
                            @php
                                $i = 0;
                                $previous_cat = 0;
                            @endphp
                            @foreach ($products_by_category as $category => $products)
                                @php
                                    $previous_cat = $category;
                                    $i++;
                                @endphp
                                <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}"
                                    id="Cat{{ $category }}" role="tabpanel"
                                    aria-labelledby="Cat{{ $category }}-tab">
                                    <div class="product-items mt-30">
                                        <div class="row product-items-active">

                                            @foreach ($products as $product)
                                                <div class="col-md">
                                                    <div class="single-product-items">
                                                        <div class="product-item-image">
                                                            <a
                                                                href="/produit/{{ $product['id'] }}/{{ $product['slug'] }}"><img
                                                                    height="320px"
                                                                    src="{{ URL::asset('images/products/' . $product['image_name']) }}"
                                                                    alt="Product"></a>
                                                            {{-- <div class="product-discount-tag">
                                                                <p>-50$</p>
                                                            </div> --}}
                                                        </div>
                                                        <div class="product-item-content text-center mt-30">
                                                            <h5 class="product-title"><a
                                                                    href="/produit/{{ $product['id'] }}/{{ $product['slug'] }}">{{ $product['name'] }}</a>
                                                            </h5>
                                                            {{-- <ul class="rating">
                                                                <li><i class="lni-star-filled"></i></li>
                                                                <li><i class="lni-star-filled"></i></li>
                                                                <li><i class="lni-star-filled"></i></li>
                                                                <li><i class="lni-star-filled"></i></li>
                                                            </ul> --}}
                                                            @if (isset($currency))
                                                                @if ($product['on_sale'])
                                                                    <span
                                                                        class="regular-price">{{ $product['sale_price'] . ' ' . $currency }}
                                                                    </span>
                                                                    <span
                                                                        class="discount-price">{{ $product['price'] . ' ' . $currency }}
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        class="regular-price">{{ $product['price'] . ' ' . $currency }}
                                                                    </span>
                                                                @endif
                                                            @endif


                                                            <add-to-cart-button custom-class="btn btn-warning text-center"
                                                                product-id={{ $product['id'] }}
                                                                user-id={{ auth()->user()->id ?? 0 }} total-quantity=1 />
                                                        </div>

                                                    </div> <!-- single product items -->
                                                </div>
                                            @endforeach

                                        </div> <!-- row -->
                                    </div> <!-- product items -->
                                </div> <!-- tab pane -->
                            @endforeach
                        @endif



                    </div> <!-- tab content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PRODUCT PART ENDS ======-->

    <!--====== COLLECTION PART START ======-->
    @if (isset($products_by_collection))
        @php
            $i = 0;
            $previous_cat = 0;
        @endphp

        @foreach ($products_by_collection as $products)
            <div class="container">
                <hr>
                <h3 class="">{{ array_values($products)[0]['collection'] }}</h3>
            </div>

            <section id="product" class="product-area pt-6 pb-50">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-md-10">
                            <div>

                                <div class="tab-pane fade show active">
                                    <div class="product-items mt-30">
                                        <div class="row product-items-active">
                                            @foreach (array_values($products) as $product)
                                                <div class="col-md">
                                                    <div class="single-product-items">
                                                        <div class="product-item-image">
                                                            <a
                                                                href="/produit/{{ $product['id'] }}/{{ $product['slug'] }}"><img
                                                                    height="350px"
                                                                    src="images/products/{{ $product['image_name'] }}"
                                                                    alt="Product"></a>
                                                            {{-- <div class="product-discount-tag">
                                                                    <p>-50$</p>
                                                                </div> --}}
                                                        </div>
                                                        <div class="product-item-content text-center mt-30">
                                                            <h5 class="product-title"><a
                                                                    href="/produit/{{ $product['id'] }}/{{ $product['slug'] }}">{{ $product['name'] }}</a>
                                                            </h5>
                                                            {{-- <ul class="rating">
                                                                    <li><i class="lni-star-filled"></i></li>
                                                                    <li><i class="lni-star-filled"></i></li>
                                                                    <li><i class="lni-star-filled"></i></li>
                                                                    <li><i class="lni-star-filled"></i></li>
                                                                </ul> --}}

                                                            @if (isset($currency))
                                                                @if ($product['on_sale'])
                                                                    <span
                                                                        class="regular-price">{{ $product['sale_price'] . ' ' . $currency }}
                                                                    </span>
                                                                    <span
                                                                        class="discount-price">{{ $product['price'] . ' ' . $currency }}
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        class="regular-price">{{ $product['price'] . ' ' . $currency }}
                                                                    </span>
                                                                @endif
                                                            @endif


                                                            <add-to-cart-button custom-class="btn btn-warning text-center"
                                                                product-id='{{ $product['id'] }}'
                                                                user-id={{ auth()->user()->id ?? 0 }} total-quantity=1 />
                                                        </div>

                                                    </div> <!-- single product items -->


                                                </div>
                                            @endforeach
                                        </div> <!-- row -->
                                    </div> <!-- product items -->
                                </div> <!-- tab pane -->




                            </div> <!-- tab content -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </section>
        @endforeach
    @endif
    <!--====== COLLECTION PART ENDS ======-->


    <!--======  BLOG PART START ======-->

    {{-- <section id="blog" class="blog-area pt-125">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h3 class="title mb-15">From The Blog</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <img src="assets/images/blog/b-1.jpg" alt="Blog">
                        </div>
                        <div class="blog-content">
                            <div class="content">
                                <h4 class="title"><a href="#">Rowan an orangutan known & loved</a></h4>
                                <span>25 JULY, 2022</span>
                            </div>
                            <div class="meta d-flex justify-content-between align-items-center">
                                <div class="meta-admin d-flex align-items-center">
                                    <div class="image">
                                        <a href="#"><img src="assets/images/blog/admin.jpg" alt="Admin"></a>
                                    </div>
                                    <div class="admin-title">
                                        <h6 class="title"><a href="#">J. PARKER</a></h6>
                                    </div>
                                </div> <!-- meta admin -->
                                <div class="meta-icon">
                                    <ul>
                                        <li><a href="#"><i class="lni-share"></i></a></li>
                                        <li><a href="#"><i class="lni-heart"></i></a></li>
                                    </ul>
                                </div> <!-- meta icon -->
                            </div> <!-- meta -->
                        </div>
                    </div> <!-- single blog -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <img src="assets/images/blog/b-2.jpg" alt="Blog">
                        </div>
                        <div class="blog-content">
                            <div class="content">
                                <h4 class="title"><a href="#">Rowan an orangutan known & loved</a></h4>
                                <span>25 JULY, 2022</span>
                            </div>
                            <div class="meta d-flex justify-content-between align-items-center">
                                <div class="meta-admin d-flex align-items-center">
                                    <div class="image">
                                        <a href="#"><img src="assets/images/blog/admin.jpg" alt="Admin"></a>
                                    </div>
                                    <div class="admin-title">
                                        <h6 class="title"><a href="#">J. PARKER</a></h6>
                                    </div>
                                </div> <!-- meta admin -->
                                <div class="meta-icon">
                                    <ul>
                                        <li><a href="#"><i class="lni-share"></i></a></li>
                                        <li><a href="#"><i class="lni-heart"></i></a></li>
                                    </ul>
                                </div> <!-- meta icon -->
                            </div> <!-- meta -->
                        </div>
                    </div> <!-- single blog -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog mt-30">
                        <div class="blog-image">
                            <img src="assets/images/blog/b-3.jpg" alt="Blog">
                        </div>
                        <div class="blog-content">
                            <div class="content">
                                <h4 class="title"><a href="#">Rowan an orangutan known & loved</a></h4>
                                <span>25 JULY, 2022</span>
                            </div>
                            <div class="meta d-flex justify-content-between align-items-center">
                                <div class="meta-admin d-flex align-items-center">
                                    <div class="image">
                                        <a href="#"><img src="assets/images/blog/admin.jpg" alt="Admin"></a>
                                    </div>
                                    <div class="admin-title">
                                        <h6 class="title"><a href="#">J. PARKER</a></h6>
                                    </div>
                                </div> <!-- meta admin -->
                                <div class="meta-icon">
                                    <ul>
                                        <li><a href="#"><i class="lni-share"></i></a></li>
                                        <li><a href="#"><i class="lni-heart"></i></a></li>
                                    </ul>
                                </div> <!-- meta icon -->
                            </div> <!-- meta -->
                        </div>
                    </div> <!-- single blog -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section> --}}

    <!--======  BLOG PART ENDS ======-->

    <!--====== CONTACT PART START ======-->

    {{-- <section id="contact" class="contact-area pt-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-title text-center">
                        <h2 class="title">Get In Touch</h2>
                    </div> <!-- contact title -->
                </div>
            </div> <!-- row -->
            <div class="contact-box mt-70">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-info pt-25">
                            <h4 class="info-title">Contact Info</h4>
                            <ul>
                                <li>
                                    <div class="single-info mt-30">
                                        <div class="info-icon">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>+88 1234 56789</p>
                                        </div>
                                    </div> <!-- single info -->
                                </li>
                                <li>
                                    <div class="single-info mt-30">
                                        <div class="info-icon">
                                            <i class="lni-envelope"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>contact@yourmail.com</p>
                                        </div>
                                    </div> <!-- single info -->
                                </li>
                                <li>
                                    <div class="single-info mt-30">
                                        <div class="info-icon">
                                            <i class="lni-home"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>203, Envato Labs, Behind Alis Steet,Australia</p>
                                        </div>
                                    </div> <!-- single info -->
                                </li>
                            </ul>
                        </div> <!-- contact info -->
                    </div>
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <form id="contact-form" action="assets/contact.php" method="post" data-toggle="validator">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-form form-group">
                                            <input type="text" name="name" placeholder="Enter Your Name"
                                                data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-form form-group">
                                            <input type="email" name="email" placeholder="Enter Your Email"
                                                data-error="Valid email is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-form form-group">
                                            <textarea name="message" placeholder="Enter Your Message" data-error="Please,leave us a message."
                                                required="required"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-lg-12">
                                        <div class="single-form form-group">
                                            <button class="main-btn" type="submit">CONTACT NOW</button>
                                        </div> <!-- single form -->
                                    </div>
                                </div> <!-- row -->
                            </form>
                        </div> <!-- row -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact box -->
        </div> <!-- container -->
    </section> --}}

    <!--====== CONTACT PART ENDS ======-->
@endsection



@section('scripts')
@endsection
