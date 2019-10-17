@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap border-b border-red-600 py-4 text-gray-800">
        @foreach($groups as $name => $streams)
            <a href="#{{$name}}" class="mr-4 border-b-2 border-transparent hover:text-blue-800 hover:border-blue-800">{{$name}}</a>
        @endforeach
    </div>
    <div class="mt-4">
        @foreach($groups as $name => $streams)
            <div class="flex flex-col mt-5">
                <a name="{{$name}}" href="#{{$name}}"><h2 class="text-2xl font-bold text-blue-800 border-b-2 border-gray-600">{{ $name }}</h2></a>
                <div class="flex flex-wrap mt-5">
                    @foreach($streams as $stream)
                        <a href="https://twitch.tv/{{$stream->user_name}}" target="_blank" class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 hover:opacity-75 p-4">
                            <div class="relative w-full bg-cover border-4 border-twitch" style="background-image: url('{{$stream->image}}'); padding-top: 56.25%;">
                                <div class="right-0 bottom-0 absolute bg-twitch text-white font-bold flex items-center justify-center w-16 rounded-tl-lg h-8">
                                    <svg class="fill-current text-white w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"/></svg>
                                    {{$stream->viewer_count}}
                                </div>
                                <div class="w-full h-full absolute inset-0 flex items-center justify-center">
                                    <svg class="tw-animated-glitch-logo__svg w-16 h-16" overflow="visible" version="1.1" viewBox="0 0 40 40" x="0px" y="0px"><g><polygon class="tw-animated-glitch-logo__body" points="13 8 8 13 8 31 14 31 14 36 19 31 23 31 32 22 32 8"><animate dur="150ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="points" from="13 8 8 13 8 31 14 31 14 36 19 31 23 31 32 22 32 8" to="16 5 8 13 8 31 14 31 14 36 19 31 23 31 35 19 35 5"></animate><animate dur="250ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="points" from="16 5 8 13 8 31 14 31 14 36 19 31 23 31 35 19 35 5" to="13 8 8 13 8 31 14 31 14 36 19 31 23 31 32 22 32 8"></animate><animate dur="50ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="points" to="13 8 8 13 8 31 14 31 14 36 19 31 23 31 32 22 32 8" from="16 5 8 13 8 31 14 31 14 36 19 31 23 31 35 19 35 5"></animate><animate dur="75ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="points" to="16 5 8 13 8 31 14 31 14 36 19 31 23 31 35 19 35 5" from="13 8 8 13 8 31 14 31 14 36 19 31 23 31 32 22 32 8"></animate></polygon><polygon class="tw-animated-glitch-logo__face" points="26 25 30 21 30 10 14 10 14 25 18 25 18 29 22 25" transform="translate(0 0)"><animateTransform dur="150ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="0 0" to="3 -3"></animateTransform><animateTransform dur="250ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="3 -3" to="0 0"></animateTransform><animateTransform dur="50ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="3 -3" to="0 0"></animateTransform><animateTransform dur="75ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="0 0" to="3 -3"></animateTransform></polygon><g class="tw-animated-glitch-logo__eyes-container" style="animation-play-state: paused; animation-name: none;"><path class="tw-animated-glitch-logo__eyes" d="M20,14 L22,14 L22,20 L20,20 L20,14 Z M27,14 L27,20 L25,20 L25,14 L27,14 Z" transform="translate(0 0)"><animateTransform dur="150ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="0 0" to="3 -3"></animateTransform><animateTransform dur="250ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="3 -3" to="0 0"></animateTransform><animateTransform dur="50ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="3 -3" to="0 0"></animateTransform><animateTransform dur="75ms" begin="indefinite" fill="freeze" calcMode="spline" keyTimes="0; 1" keySplines="0.25 0.1 0.25 1" attributeName="transform" type="translate" from="0 0" to="3 -3"></animateTransform></path></g></g></svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-medium truncate">{{$stream->title}}</h3>
                            <h4 class="text-blue-800 font-medium">{{$stream->user_name}}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection