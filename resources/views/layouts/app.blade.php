<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .text-twitch {
            color: #9147ff;
        }
        .bg-twitch {
            background-color: #9147ff;
        }
        .border-twitch {
            border-color: #9147ff;
        }
        .tw-animated-glitch-logo__body {
            fill: #9147ff;
        }
        .tw-animated-glitch-logo__face {
            fill: #fff;
        }
    </style>
</head>
<body class="bg-gray-400">
    <div class="container mx-auto flex flex-col mb-32 mt-8">
        <div class="flex border-b border-red-600 pb-2">
            <h1 class="text-4xl font-bold text-red-600"><span class="bg-red-600 text-white uppercase px-4 py-1 rounded">Live</span> Coding Streams</h1>
        </div>
        @yield('content')
    </div>
    <div class="text-center">
        A project by<br>
        <a href="https://KraKero.com" class="hover:underline">KraKero</a>
    </div>
</body>
</html>