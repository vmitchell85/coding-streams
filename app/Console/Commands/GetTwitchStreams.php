<?php

namespace App\Console\Commands;

use App\Term;
use App\Stream;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use romanzipp\Twitch\Facades\Twitch;

class GetTwitchStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:twitch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches streams from Twitch';

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
        $this->fetchStreamsByGameId(21548); // Basic Programming
        $this->fetchStreamsByGameId(509670); // Science & Technology
    }

    public function fetchStreamsByGameId($game_id)
    {
        do {
            $result = Twitch::getStreamsByGame($game_id, ['first' => 100], isset($result) ? $result->next() : null);

            foreach ($result->data as $item) {
                foreach (Term::all() as $term) {
                    if (Str::contains(strtolower($item->title), $term->text)) {
                        Stream::updateOrCreate([
                            'identifier' => $item->id,
                            'query' => $term->text,
                            'service' => 'twitch'
                        ], [
                            'title' => $item->title,
                            'user_name' => $item->user_name,
                            'viewer_count' => $item->viewer_count,
                            'image' => str_replace('{width}x{height}', '640x360', $item->thumbnail_url),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        } while ($result->count() > 0);
    }
}
