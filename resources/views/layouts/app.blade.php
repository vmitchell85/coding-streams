<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .text-youtube {
            color: #FF0000;
        }
        .bg-youtube {
            background-color: #FF0000;
        }
        .border-youtube {
            border-color: #FF0000;
        }
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
    <div class="mx-4 md:w-3/4 md:mx-auto flex flex-col mb-32 mt-8">
        <div class="flex flex-col md:flex-row justify-between items-center border-b border-red-600 pb-2">
            <h1 class="text-4xl font-bold text-red-600"><span class="bg-red-600 text-white uppercase px-4 py-1 rounded">Live</span> Coding Streams</h1>
            <a href="#about" class="text-red-600 text-2xl font-bold">About</a>
        </div>
        @yield('content')
    </div>
    <div class="mx-4 flex flex-col md:w-3/4 md:mx-auto text-sm">
        <a name="about"><h2 class="font-bold text-2xl text-red-600 border-b border-red-600">About</h2></a>
        <div class="mt-4">
            This site shows all streams that are currently live within the last five minutes using the following terms:
            <div class="flex flex-wrap font-medium mt-4">
                @foreach(App\Term::select('text')->get()->map->text->toArray() as $term)
                    <div class="bg-gray-700 px-2 py-1 rounded text-white mr-2 mt-2">{{$term}}</div>
                @endforeach
            </div>
        </div>
        <div class="flex my-8">
            <div class="w-1/2">
                Don't see what you're looking for? Hit me up on <a href="https://twitter.com/vmitchell85" class="text-blue-800 underline">twitter</a> or submit a <a href="https://github.com/vmitchell85/coding-streams" class="text-blue-800 underline">PR</a>.
            </div>
            <div class="w-1/2 text-right">
                This is a project by <a href="https://vincemitchell.me" class="text-blue-800 underline">Vince Mitchell</a>.
            </div>
        </div>
    </div>
</body>
</html>