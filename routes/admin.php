<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::get('/', \App\Livewire\Admin\Home::class);

    Route::get('/leagues', \App\Livewire\Admin\Leagues::class)
        ->middleware(['can:Admin Create Leagues'])
        ->name('admin.leagues');

    Route::get('/leagues/{league:id}', \App\Livewire\Admin\EditLeague::class)
        ->middleware(['can:Admin Create Leagues'])
        ->name('admin.leagues.edit');

    Route::get('/clubs', \App\Livewire\Admin\Clubs::class)
        ->middleware(['can:Admin Create Clubs'])
        ->name('admin.clubs');

    Route::get('/clubs/{club:id}', \App\Livewire\Admin\EditClub::class)
        ->middleware(['can:Admin Create Clubs'])
        ->name('admin.clubs.edit');

    Route::get('/users', \App\Livewire\Admin\Users::class)
        ->middleware(['can:Admin Manage Users'])
        ->name('admin.users');

    Route::get('/contracts', \App\Livewire\Admin\Contracts::class)
        ->middleware(['can:Admin Create Contracts'])
        ->name('admin.contracts');

    Route::get('/fixtures', \App\Livewire\Admin\Fixtures::class)
        ->middleware(['can:Admin Create Fixtures'])
        ->name('admin.fixtures');

    Route::get('/fixtures/{fixture:id}', \App\Livewire\Admin\EditFixture::class)
        ->middleware(['can:Admin Create Fixtures'])
        ->name('admin.fixtures.edit');

    Route::get('/fixtures/default/{fixture:id}', \App\Livewire\Admin\DefaultFixture::class)
        ->middleware(['can:Admin Create Fixtures'])
        ->name('admin.fixtures.default');
});

?>
