<?php

namespace App\Console\Commands;

use App\Stream;
use Illuminate\Console\Command;

class CleanupStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streams:cleanup {minutes=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes streams that are no longer live';

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
        $minutes = $this->argument('minutes');
        $this->info('Deleting streams that haven\'t been updated in ' . $minutes . ' minutes');
        Stream::query()
            ->where('updated_at', '<' , now()->subMinutes($minutes))
            ->get()
            ->each
            ->delete();
    }
}
