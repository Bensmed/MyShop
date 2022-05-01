@extends('layouts.frontend')

@section('title')
    <title>Profil</title>
@endsection

@section('content')
    <section id="profile" style="margin-top: 100px;">
        <div class="container" style="margin-bottom: 50px;">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </nav>
        </div>

        @if (isset($myProfile))
            <profile my-id={{ auth()->user()->id }} my-name="{{ $myProfile->name }}"
                my-phone="{{ $myProfile->phone }}" my-email={{ $myProfile->email }}
                my-address="{{ $myProfile->address }}" my-state="{{ $myProfile->state }}"
                my-city="{{ $myProfile->city }}" />
        @endif
    </section>
@endsection
