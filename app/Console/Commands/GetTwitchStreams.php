<?php

namespace App\Console\Commands;

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
    protected $signature = 'fetch:twitch {query}';

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
        $query = $this->argument('query');
        do {
            // 509670 is Science & Technology
            $result = Twitch::getStreamsByGame(509670, ['first' => 100], isset($result) ? $result->next() : null);

            foreach ($result->data as $item) {
                if (Str::contains(strtolower($item->title), $query)) {
                    Stream::updateOrCreate([
                        'twitch_id' => $item->id,
                        'query' => $query,
                    ], [
                        'title' => $item->title,
                        'user_name' => $item->user_name,
                        'viewer_count' => $item->viewer_count,
                        'image' => str_replace('{width}x{height}' , '640x360', $item->thumbnail_url),
                        'query' => $query,
                        'updated_at' => now()
                    ]);
                }
            }
        } while ($result->count() > 0);
    }
}
