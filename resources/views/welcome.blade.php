<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="/css/app.css" rel="stylesheet" />

        <script>
            function copyToClipboard() {
                var copyLink = document.getElementById("output");
                copyLink.select();
                copyLink.setSelectionRange(0, 99999);
                document.execCommand("copy");
            }
        </script>

        <title>shrink.me</title>

        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet" />

        <style>
            html,
            body {
                height: calc(100%) !important;
                background-color: white;
                font-family: "Lato", sans-serif;
                font-weight: 200;
                height: 100vh;
                padding-top: 3%;
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

            .title {
                font-size: 5.5em;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 0.1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>

    <body>
        <div class="container text-center">
            <div class="title m-b-md text-primary">
                shrink.me
            </div>
            @if (!empty($error))
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>

            @endif
            <form action="/shorten" method="POST">
                <div class="form-group row justify-content-center">
                    @csrf
                    <div class="input-group w-50 p-3">
                        <input type="url" name="original_link" class="form-control" placeholder="paste your link to shorten" />
                        <button type="submit" class="btn btn-primary">shrink!</button>
                    </div>
                </div>
            </form>

            @if (isset($short_link))
            <div class="input-group card-body w-25 p-3 container">
                <input type="text" value="{{$short_link}}" class="form-control-plaintext form-rounded w-25 p-3 border" />
                <button onclick="copyToClipboard()" class="btn btn-primary border form-rounded">
                    <svg width="2em" viewBox="0 0 16 16" class="bi bi-clipboard" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                </button>
            </div>
            <p class="text-primary">visited {{$visited_counter ?? 0}} times</p>
        </div>
        @endif
    </body>
</html>
