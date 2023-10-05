<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <style id="compiled-css" type="text/css">
            #map {
                height: 100%;
            }

            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: "Roboto", sans-serif;
                font-size: 18px;
                color: rgb(104, 104, 104);
            }

            form {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                max-width: 400px;
                padding: 20px;
            }

            input {
                width: 100%;
                height: 1.2rem;
                margin-top: 0;
                padding: 0.5em;
                border: 0;
                border-bottom: 2px solid gray;
                font-family: "Roboto", sans-serif;
                font-size: 18px;
            }

            input:focus {
                border-bottom: 4px solid black;
            }

            input[type=reset] {
                width: auto;
                height: auto;
                border-bottom: 0;
                background-color: transparent;
                color: rgb(104, 104, 104);
                font-size: 14px;
            }

            .title {
                width: 100%;
                margin-block-end: 0;
                font-weight: 500;
            }

            .note {
                width: 100%;
                margin-block-start: 0;
                font-size: 12px;
            }

            .form-label {
                width: 100%;
                padding: 0.5em;
            }

            .full-field {
                flex: 400px;
                margin: 15px 0;
            }

            .slim-field-left {
                flex: 1 150px;
                margin: 15px 15px 15px 0px;
            }

            .slim-field-right {
                flex: 1 150px;
                margin: 15px 0px 15px 15px;
            }

            .my-button {
                background-color: #000;
                border-radius: 6px;
                color: #fff;
                margin: 10px;
                padding: 6px 24px;
                text-decoration: none;
            }

            .my-button:hover {
                background-color: #666;
            }

            .my-button:active {
                position: relative;
                top: 1px;
            }

            img.powered-by-google {
                margin: 0.5em;
            }

            .bt-submit {
                height: 30px;
                border: 1px solid #000;
            }
        </style>

        @bukStyles
        @bukScripts
        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased">
        {{ $slot }}

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
