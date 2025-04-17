<?php

namespace App\Console\Commands;

use App\Jobs\RebuildLeaderboardsJob;
use Illuminate\Console\Command;

class RebuildLeaderboardsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rebuild-leaderboards-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        RebuildLeaderboardsJob::dispatch();
    }
}
