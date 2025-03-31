<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class League extends Model implements HasMedia
{

    use InteractsWithMedia, HasFactory;
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
