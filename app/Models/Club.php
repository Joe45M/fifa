<?php

namespace App\Models;

use App\Enum\ContractStatus;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
