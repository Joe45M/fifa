<?php

use App\Http\Middleware\ManagerMiddleware;
use App\Livewire\ClubProfile;
use App\Livewire\Dashboard;
use App\Livewire\FixtureDetails;
use App\Livewire\LeagueTable;
use App\Livewire\Manage\ManageContracts;
use App\Livewire\Manage\ManageDashboard;
use App\Livewire\Manage\ManageFixtures;
use App\Livewire\Manage\ManageRoster;
use App\Livewire\Manage\ManageSubmitStats;
use App\Livewire\MyContracts;
use App\Livewire\UserProfile;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('fixture/{fixture:id}', FixtureDetails::class)
    ->name('fixture.view');


Route::get('/my-contracts', MyContracts::class)
    ->middleware(['auth'])
    ->name('my-contracts');

Route::get('/club/{club:name}', ClubProfile::class)->name('club');

Route::get('/p/{user:name}', UserProfile::class)->name('user.profile')
    ->middleware(['auth']);

Route::get('/league/{league:id}', LeagueTable::class)->name('league');

Route::prefix('/m')->group(function () {
    Route::get('/', ManageDashboard::class)->name('manage.dashboard')->middleware([ManagerMiddleware::class]);
    Route::get('/contracts', ManageContracts::class)->name('manage.contracts')->middleware([ManagerMiddleware::class]);
    Route::get('/roster', ManageRoster::class)->name('manage.roster')->middleware([ManagerMiddleware::class]);
    Route::get('/fixtures', ManageFixtures::class)->name('manage.fixtures')->middleware([ManagerMiddleware::class]);
    Route::get('/fixtures/submit/{fixture:id}', ManageSubmitStats::class)->name('manage.submit')->middleware([ManagerMiddleware::class]);
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
