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
});

?>
