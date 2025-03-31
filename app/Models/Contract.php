<?php

namespace App\Models;

use App\Enum\ContractStatus;
use App\Enum\ContractType;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    public $fillable = [
        'user_id',
        'club_id',
        'season',
        'length',
        'games_remaining',
        'status',
        'type',
    ];

    public $casts = [
        'status' => ContractStatus::class,
        'type' => ContractType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function scopeOffered($query)
    {
        return $query->where('status', ContractStatus::Offered);
    }
}
