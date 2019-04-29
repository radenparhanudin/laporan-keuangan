<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laporan Keuangan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .flat {
                border-radius: 0px;
                width: 150px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary flat">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-danger flat" role="">Login User</a>
                            {{-- <a href="{{ route('register') }}">Register</a> --}}
                        @endauth
                    </div>
                @endif

                <div class="content">
                    <div class="title m-b-md">
                        Laporan Keuangan
                    </div>
                    <h2>Laporan Keuangan - Tugas Kewirausahaan</h2>
                </div>
            </div>
        </div>
    </body>
</html>
