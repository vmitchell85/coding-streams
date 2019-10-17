<?php

namespace App\Console\Commands;

use App\Term;
use App\Stream;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Alaouy\Youtube\Facades\Youtube;

class GetYoutubeStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:youtube';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch streams for Youtube';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $excludedCategories = collect([
            1, //Film & Animation
            2, //Autos & Vehicles
            10, //Music
            15, //Pets & Animals
            17, //Sports
            18, //Short Movies
            19, //Travel & Events
            20, //Gaming
                // 21, //Videoblogging
                // 22, //People & Blogs
                // 23, //Comedy
                // 24, //Entertainment
                // 25, //News & Politics
            26, //Howto & Style
                // 27, //Education
                // 28, //Science & Technology
            29, //Nonprofits & Activism
            30, //Movies
            31, //Anime/Animation
            32, //Action/Adventure
            33, //Classics
            34, //Comedy
                // 35, //Documentary
                // 36, //Drama
                // 37, //Family
            38, //Foreign
            39, //Horror
            40, //Sci-Fi/Fantasy
            41, //Thriller
            42, //Shorts
                // 43, //Shows
            44, //Trailers
        ]);

        Term::all()->each(function ($term) use ($excludedCategories) {
            $searchResults = Youtube::searchAdvanced([
                'part' => 'snippet',
                'q' => $term->text,
                'type' => 'video',
                'eventType' => 'live',
            ]);

            // Science & Tech category is 28

            if ($searchResults) {
                collect($searchResults)->each(function ($item) use ($term, $excludedCategories) {
                    if (Str::contains(strtolower($item->snippet->title), $term->text) || Str::contains(strtolower($item->snippet->description), $term->text)) {
                        $extraData = Youtube::getVideoInfo($item->id->videoId);
                        if (!$excludedCategories->contains($extraData->snippet->categoryId)) {
                            Stream::updateOrCreate([
                                'identifier' => $item->id->videoId,
                                'query' => $term->text,
                                'service' => 'youtube'
                            ], [
                                'identifier' => $item->id->videoId,
                                'query' => $term->text,
                                'service' => 'youtube',
                                'title' => $item->snippet->title,
                                'user_name' => $item->snippet->channelTitle,
                                'viewer_count' => $extraData->statistics->viewCount,
                                'image' => $item->snippet->thumbnails->high->url,
                                'updated_at' => now()
                            ]);
                        }
                    }
                });
            }
        });
    }
}
