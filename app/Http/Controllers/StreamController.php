<?php

namespace App\Http\Controllers;

use App\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function index()
    {
        $streamGroups = Stream::query()
            ->orderBy('viewer_count', 'desc')
            ->get()
            ->sortBy('query')
            ->groupBy('query');

        return view('streams.index')
            ->withGroups($streamGroups);
    }
}
