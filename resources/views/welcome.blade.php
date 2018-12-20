<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                /*text-transform: uppercase;*/
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @if(auth()->check())
                    welcome,
                    <a href="/u/{{auth()->user()['id']}}">{{auth()->user()['name']}}</a>
                    <a href="/logout">Logout</a>
                @else
                    <a href="/login">login</a>
                    <a href="/register">Register</a>
                @endif
            </div>

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                @if(auth()->check())
                    <div class="links">
                        <a href="/u/{{auth()->user()['id']}}">User Profile</a>
                        <a href="/payment">Donate</a>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
