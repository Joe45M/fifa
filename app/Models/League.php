<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class League extends Model implements HasMedia
{

    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'season',
        'description',
        'status',
        'primaryImage'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo');
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
