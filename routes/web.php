<?php

use App\Livewire\Dashboard;
use App\Livewire\Manage\ManageContracts;
use App\Livewire\Manage\ManageDashboard;
use App\Livewire\Manage\ManageFixtures;
use App\Livewire\Manage\ManageRoster;
use App\Livewire\Manage\ManageSubmitStats;
use App\Livewire\MyContracts;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('/my-contracts', MyContracts::class)
    ->middleware(['auth'])
    ->name('my-contracts');

Route::prefix('/m')->group(function () {
    Route::get('/', ManageDashboard::class)->name('manage.dashboard');
    Route::get('/contracts', ManageContracts::class)->name('manage.contracts');
    Route::get('/roster', ManageRoster::class)->name('manage.roster');
    Route::get('/fixtures', ManageFixtures::class)->name('manage.fixtures');
    Route::get('/fixtures/submit/{fixture:id}', ManageSubmitStats::class)->name('manage.submit');
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
