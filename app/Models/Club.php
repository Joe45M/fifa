<?php

namespace App\Models;

use App\Enum\ContractStatus;
use Awobaz\Compoships\Compoships;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{

    use InteractsWithMedia, HasFactory;
    public $fillable = ['name', 'status', 'league_id'];

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function fixtures()
    {
        return $this->hasMany(Fixture::class)->where('');
    }

    public function players()
    {
        return $this->hasManyThrough(User::class, Contract::class,
            'club_id',
            'id',
            'id',
            'user_id')->where('contracts.status', ContractStatus::Active);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Get the home fixtures for the club.
     */
    public function homeFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'home_club_id');
    }

    /**
     * Get the away fixtures for the club.
     */
    public function awayFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'away_club_id');
    }
    public function getFixturesAttribute()
    {
        return $this->homeFixtures()->get()->merge($this->awayFixtures()->get());
    }
}
