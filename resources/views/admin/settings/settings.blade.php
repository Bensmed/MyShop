@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Paramètres</title>
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
    <div class="container pt-60 pb-100">
        <div class="card">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                        aria-controls="general" aria-selected="true"><i class="fa-solid fa-gear mr-2"></i>Paramètre
                        Générale</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="logo"
                        aria-selected="false"><i class="fa-solid fa-flag mr-2"></i>Logo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab"
                        aria-controls="social" aria-selected="false"><i class="fa-solid fa-share-nodes mr-2"></i>Média
                        socieaux</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="colors-tab" data-toggle="tab" href="#colors" role="tab"
                        aria-controls="colors" aria-selected="false"><i class="fa-solid fa-palette mr-2"></i>Couleurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="more-tab" data-toggle="tab" href="#more" role="tab" aria-controls="more"
                        aria-selected="false"><i class="fa-solid fa-ellipsis mr-2"></i></i>Plus de
                        paramètres</a>
                </li>
            </ul>
            <hr>
            <div class="card-body">
                @if (isset($settings))
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10">

                                        <general-settings-form ex-title='{{ $settings->website_title }}'
                                            ex-email='{{ $settings->email }}' ex-address='{{ $settings->address }}'
                                            ex-phone1='{{ $settings->phone1 }}' ex-phone2='{{ $settings->phone2 }}'
                                            ex-description='{{ $settings->website_description }}' />

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10">

                                        <logo-form ex-logo='{{ $settings->logo }}'
                                            ex-favicon='{{ $settings->favicon }}' />

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10">

                                        <social-media-form ex-facebook='{{ $settings->facebook }}'
                                            ex-instagram='{{ $settings->instagram }}'
                                            ex-twitter='{{ $settings->twitter }}' />

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="colors" role="tabpanel" aria-labelledby="colors-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10">

                                        <colors-form ex-primary-color='{{ $settings->primary_color }}'
                                            ex-hover-color='{{ $settings->hover_color }}'
                                            ex-transparent-color='{{ $settings->transparent_color }}' />

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10">

                                        <more-settings-form ex-currency='{{ $settings->currency }}'
                                            ex-facebook_pixel='{{ $settings->facebook_pixel }}'></more-settings-form>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section(' scripts')
@endsection
