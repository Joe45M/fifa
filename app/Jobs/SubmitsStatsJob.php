<?php

namespace App\Jobs;

use App\Enum\FixtureStatus;
use App\Enum\StatStatus;
use App\Models\Fixture;
use App\Models\FixtureMeta;
use App\Models\User;
use App\Models\UserStat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubmitsStatsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $stats)
    {


//        $response = Http::post($webhookUrl, [
//            'embeds' => [$embed],
//        ]);
//
//// Check if the request was successful
//        if ($response->successful()) {
//            echo 'Alert sent successfully!';
//        } else {
//            echo 'Failed to send alert.';
//        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $location = false;

        foreach ($this->stats['stats'] as $userId => $statGroup) {

            foreach ($statGroup as $stat => $value) {


                $user = User::find($userId);

                if (!$location) {
                    $location = $this->stats['fixture']->location($user->currentContract->club);
                }

                UserStat::create([
                    'fixture_id' => $this->stats['fixture']->id,
                    'club_id' => $user->currentContract->club->id,
                    'user_id' => $userId,
                    'season' => $user->currentContract->club->league->season,
                    'totw_points' => 0,
                    'value' => $value,
                    'stat' => $stat,
                    'position' => 'gk',
                    'status' => StatStatus::Inactive,
                ]);
            }
        }

        $otherLocation = 'away';

        if ($location === 'away') {
            $otherLocation = 'home';
        }

        $otherTeamHasPropped = Fixture::findOrFail($this->stats['fixture']->id)
        ->fixtureMeta()->where('meta_key', $otherLocation . '_propped')
            ->exists();

        if ($otherTeamHasPropped) {
            Fixture::findOrFail($this->stats['fixture']->id)->update([
                'status' => FixtureStatus::Pending,
            ]);
        }

        // create meta for this team
        FixtureMeta::create([
            'fixture_id' => $this->stats['fixture']->id,
            'meta_key' => $location . '_propped',
            'meta_value' => true,
        ]);

        FixtureMeta::create([
            'fixture_id' => $this->stats['fixture']->id,
            'meta_key' => $location . '_propped_score',
            'meta_value' => $this->stats['score']['home'] . '-' . $this->stats['score']['away'],
        ]);

        try {
            $webhookUrl = 'https://discord.com/api/webhooks/1358277128818393139/41oxBeMCN9JUtwh39lMzUhfnN7Hv_k8BqK67q51xlqiZW5KLCQjgmmed0A7FUUITFg6E'; // Replace with your actual webhook URL

            $embed = [
                'title' => 'System Alert',
                'description' => 'Application has begun processing a stat submission for the fixture: ' . $this->stats['fixture']->homeClub->name . ' vs ' . $this->stats['fixture']->awayClub->name,
                'color' => 15258703, // Decimal color code
            ];

//            $response = Http::post($webhookUrl, [
//                'embeds' => [$embed],
//            ]);
        } catch (\Throwable $e) {
            // Handle the exception
            Log::error('Failed to send Discord webhook: ' . $e->getMessage());
        }
    }
}
