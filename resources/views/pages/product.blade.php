@extends('layouts.frontend')

@section('title')
    @if (isset($product))
        <title>{{ $product->name }}</title>
    @endif
@endsection

@section('content')
    <section id='product'>
        @if (isset($product) && isset($currency))
            <product :value='{{ json_encode($product) }}' user={{ auth()->user()->id ?? 0 }}
                store-currency='{{ $currency }}' />
        @endif
    </section>
@endsection
