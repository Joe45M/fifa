<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GiveAdminToUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give admin privileges. to a user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = $this->ask('Which user ID?');
        $user = User::findOrFail($user);

        $user->assignRole('Administrator');

        $this->info('Role assigned to ' . $user->name);
    }
}
