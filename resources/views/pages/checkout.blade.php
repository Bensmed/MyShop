@extends('layouts.frontend')

@section('title')
    <title>Mon panier</title>
@endsection

@section('styles')
    <style>
        body {
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            letter-spacing: 0px;
            font-weight: 400;

            background: #fff;
            font-size: 16px;
            color: #6b7380;
            font-family: "Source Sans Pro", sans-serif;
            color: #383838;
        }



        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            letter-spacing: 0px;
            font-weight: 700;
            color: #1c1e22;
            margin: 0px 0px 15px 0px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        h1 {
            font-size: 42px;
            line-height: 50px;
        }

        h2 {
            font-size: 36px;
            line-height: 42px;
        }

        h3 {
            font-size: 24px;
            line-height: 32px;
        }

        h4 {
            font-size: 20px;
            line-height: 32px;
        }

        h5 {
            font-size: 14px;
            line-height: 20px;
        }

        h6 {
            font-size: 12px;
            line-height: 18px;
        }


        ul,
        ol {}

        a {
            text-decoration: none;
            color: #2e3139;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        a:focus,
        a:hover {
            text-decoration: none;
            color: #0943c6;
        }

        .content {
            padding-top: 80px;
            padding-bottom: 80px
        }

        ;


        /*------------------------
                                                                                                                                                                                                                                                                                                                                                                                Radio & Checkbox CSS
                                                                                                                                                                                                                                                                                                                                                                                -------------------------*/
        .form-control {
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            height: 70px;
            padding: 14px 18px;
            line-height: 1.42857143;
            border: 1px solid #dfe2e7;
            background-color: #dfe2e7;
            text-transform: capitalize;
            letter-spacing: 0px;
            margin-bottom: 16px;
            -webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075);
            box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075);
            -webkit-appearance: none;
        }

        input[type=radio].with-font,
        input[type=checkbox].with-font {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        input[type=radio].with-font~label:before,
        input[type=checkbox].with-font~label:before {
            font-family: FontAwesome;
            display: inline-block;
            content: "\f1db";
            letter-spacing: 10px;
            font-size: 1.2em;
            color: #dfe2e7;
            width: 1.4em;
        }

        input[type=radio].with-font:checked~label:before,
        input[type=checkbox].with-font:checked~label:before {
            content: "\f00c";
            font-size: 1.2em;
            color: #0943c6;
            letter-spacing: 5px;
        }

        input[type=checkbox].with-font~label:before {
            content: "\f096";
        }

        input[type=checkbox].with-font:checked~label:before {
            content: "\f046";
            color: #0943c6;
        }

        input[type=radio].with-font:focus~label:before,
        input[type=checkbox].with-font:focus~label:before,
        input[type=radio].with-font:focus~label,
        input[type=checkbox].with-font:focus~label {}

        .box {
            background-color: #fff;
            border-radius: 8px;
            border: 2px solid #e9ebef;
            padding: 50px;
            margin-bottom: 40px;
        }

        .box-title {
            margin-bottom: 30px;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: 700;
            color: #094bde;
            letter-spacing: 2px;
        }

        .plan-selection {
            border-bottom: 2px solid #e9ebef;
            padding-bottom: 25px;
            margin-bottom: 35px;
        }

        .plan-selection:last-child {
            border-bottom: 0px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }

        .plan-data {
            position: relative;
        }

        .plan-data label {
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: 400;
        }

        .plan-text {
            padding-left: 35px;
        }

        .plan-price {
            position: absolute;
            right: 0px;
            color: #094bde;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 1.5;
            bottom: 43px;
        }

        .term-price {
            bottom: 18px;
        }

        .secure-price {
            bottom: 68px;
        }

        .summary-block {
            border-bottom: 2px solid #d7d9de;
        }

        .summary-block:last-child {
            border-bottom: 0px;
        }

        .summary-content {
            padding: 28px 0px;
        }

        .summary-price {
            color: #094bde;
            font-size: 20px;
            font-weight: 400;
            letter-spacing: -1px;
            margin-bottom: 0px;
            display: inline-block;
            float: right;
        }

        .summary-small-text {
            font-weight: 700;
            font-size: 12px;
            color: #8f929a;
        }

        .summary-text {
            margin-bottom: -10px;
        }

        .summary-title {
            font-weight: 700;
            font-size: 14px;
            color: #1c1e22;
        }

        .summary-head {
            display: inline-block;
            width: 120px;
        }

        .widget {
            margin-bottom: 30px;
            background-color: #e9ebef;
            padding: 50px;
            border-radius: 6px;
        }

        .widget:last-child {
            border-bottom: 0px;
        }

        .widget-title {
            color: #094bde;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 25px;
            letter-spacing: 1px;
            display: table;
            line-height: 1;
        }

        .btn {
            font-family: 'Noto Sans', sans-serif;
            font-size: 16px;
            text-transform: capitalize;
            font-weight: 700;
            padding: 12px 36px;
            border-radius: 4px;
            line-height: 2;
            letter-spacing: 0px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
            word-wrap: break-word;
            white-space: normal !important;
        }

        .btn-default {
            background-color: #0943c6;
            color: #fff;
            border: 1px solid #0943c6;
        }

        .btn-default:hover {
            background-color: #063bb3;
            color: #fff;
            border: 1px solid #063bb3;
        }

        .btn-default.focus,
        .btn-default:focus {
            background-color: #063bb3;
            color: #fff;
            border: 1px solid #063bb3;
        }

        .checkoutBox {
            margin-top: 150px;
        }

        .card-shop .media {
            margin-bottom: 10px;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
        }

        .card-shop .media .media-body {
            margin: 0;
            padding: 20px;
            list-style: none;
            text-decoration: none;
        }

        .card-shop .media .media-body a {
            font-weight: 500;
            font-size: 16px;
            color: #8d8d8d;
        }

        .card-quantity {
            border: 1px solid #f1f1f1;
            background: #f7f7f7;
            padding: 5px;
            max-width: 50px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 14px;
            color: #616161;
            text-align: center;
            outline: #aaa;
        }

        .card-shop .form-control {
            padding: 30px 20px;
            background: #f5f5f5;
            border-radius: 0px;
            border: 0px;
        }

        .delete-wish a {
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .card-quantity {
            margin-top: 0.8rem;
            margin-left: 0.5rem;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            opacity: 1;
        }

    </style>
@endsection


@section('content')
    <section>
        @isset($currency)
            <checkout store-currency='{{ $currency }}' />
        @endisset

    </section>
@endsection
