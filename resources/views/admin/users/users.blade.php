@extends('layouts.frontend')

@section('title')
    <title>Dashboard - Utilisateurs</title>
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
            font-weight: 500;
        }

        a {
            color: #f35b3f;
            text-decoration: none;
            transition: all .3s;
        }

        a:hover,
        a:focus {
            color: #f35b3f;
            border: 0;
            text-decoration: none;
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
    <section>
        <div class="container pt-10">
            <div class="row mb-4">
                <h1><i class="fas fa-user mr-2"></i> Liste des utilisateurs: </h1>
            </div>
            <div class="card">
                <table class=" table table-hover" style="background-color: white;color: #1E1E1E;">
                    <thead style="background-color: rgba(253, 120, 101, 0.7)">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nom et prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Wilaya</th>
                            <th scope="col">Commune</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($users))
                            @foreach ($users as $user)
                                <tr is="user-row" user-id={{ $user->id }} user-name='{{ $user->name }}'
                                    user-email='{{ $user->email }}' user-address='{{ $user->address }}'
                                    user-wilaya='{{ $user->state }}' user-city='{{ $user->city }}'
                                    user-role='{{ $user->role }}'></tr>
                            @endforeach

                    </tbody>
                </table>

                @php
                    if ($users->url($users->currentPage()) == $users->url(1)) {
                        $isFirstPage = true;
                    } else {
                        $isFirstPage = false;
                    }

                    if ($users->url($users->currentPage()) == $users->url($users->lastPage())) {
                        $isLastPage = true;
                    } else {
                        $isLastPage = false;
                    }

                @endphp

                <ul class="pagination text-center mx-auto">

                    <li @class(['page-item', 'disabled' => $isFirstPage])><a class="page-link"
                            href="{{ $users->previousPageUrl() }}">Précédent</a></li>

                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        @php
                            if ($users->currentPage() == $i) {
                                $isActive = true;
                            } else {
                                $isActive = false;
                            }
                        @endphp
                        <li @class(['page-item', 'active' => $isActive])><a class="page-link"
                                href="{{ $users->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    <li @class(['page-item', 'disabled' => $isLastPage])>

                        <a class="page-link" href="{{ $users->nextPageUrl() }}">Suivant</a>
                    </li>

                </ul>
                @endif
            </div>
        </div>
    </section>
@endsection


@section('scripts')
@endsection
