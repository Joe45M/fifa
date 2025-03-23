<?php

namespace App\Models;

use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{

    use InteractsWithMedia;
    public $fillable = ['name', 'status', 'league_id'];

    public function league()
    {
        return $this->belongsTo(League::class);
    }
}
