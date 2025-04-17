<?php

namespace App\Jobs;

use App\Models\UserStat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RebuildLeaderboardsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $stats = [
            'goals',
            'assists',
            'saves',
            'shots',
            'passes',
            'tackles',
            'interceptions',
            'fouls',
            'yellow_cards',
            'red_cards',
        ];

        foreach ($stats as $stat) {
            $users = UserStat::where('stat', $stat)->get(['id', 'value'])->groupBy('user_id');

            foreach ($users as $group) {

                $ob = $group->first()->load('user');

                dd($group->first()->user->name);

                $total = [
                    'sum' => $group->sum('value'),
                    'user_name' => $group->first()->user->name,
                    'user_id' => $group->first()->user->id,
                ];

                dump($total);
            }

        }
    }
}
