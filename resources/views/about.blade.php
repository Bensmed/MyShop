@extends('layouts.frontend')

@section('styles')
    <style>
        h1 {
            font-size: 46px;
            color: #555;
        }

    </style>
@endsection


@section('content')
    <div class="container pt-30 pb-100">
        <h1>À propos:</h1>
        <div class="row mt-50">
            <div class="col-md-11 mx-auto">
                @if (isset($content))
                    {!! $content !!}
                @endif

            </div>

        </div>


    </div>
@endsection



@section('scripts')
@endsection
