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
        Term::all()->each(function ($term) {
            $searchResults = Youtube::searchAdvanced([
                'part' => 'snippet',
                'q' => '#' . $term->text,
                'type' => 'video',
                'eventType' => 'live'
            ]);

            if ($searchResults) {
                collect($searchResults)->each(function ($item) use ($term) {
                    if (Str::contains(strtolower($item->snippet->title), $term->text) || Str::contains(strtolower($item->snippet->description), $term->text)) {
                        $extraData = Youtube::getVideoInfo($item->id->videoId);
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
                });
            }
        });
    }
}
