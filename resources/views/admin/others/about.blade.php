@extends('layouts.frontend')

@section('title')
    <title>Dashboard - À propos</title>
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

    <script src="{{ URL::to('src/vendor/tinymce/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute: "{{ URL::to('/') }}/",
            selector: "textarea#aboutPage",
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };
        tinymce.init(editor_config);
    </script>
@endsection

@section('content')
    <div class="container pt-10">
        <div class="row mb-5">
            <h1>À propos:</h1>
        </div>

        @if (isset($content))
            <edit-about edit-about='{{ $content }}' />
        @endif
    </div>
@endsection


@section(' scripts')
@endsection
