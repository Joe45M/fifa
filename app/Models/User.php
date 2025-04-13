<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\ContractStatus;
use App\Enum\ContractType;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function getCurrentContractAttribute()
    {
        return $this->contracts()->where('status', ContractStatus::Active)->first();
    }

    public function getImageAttribute()
    {
        $image = $this->getFirstMediaUrl('image');

        if (!$image) {
            return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?d=mp';
        }

        return $image;
    }

    public function stats()
    {
        return $this->hasMany(UserStat::class);
    }

    public function getPlayedAttribute()
    {
        return $this->hasMany(UserStat::class)->where('stat', 'assists')->count();
    }

    public function goals()
    {
        return $this->stats()->where('stat', 'goals');
    }

    public function tackles()
    {
        return $this->stats()->where('stat', 'tackles');
    }

    public function assists()
    {
        return $this->stats()->where('stat', 'assists');
    }

    public function passes()
    {
        return $this->stats()->where('stat', 'passes');
    }

    public function shots()
    {
        return $this->stats()->where('stat', 'shots');
    }

    public function yellowCards()
    {
        return $this->stats()->where('stat', 'yellow_cards');
    }

    public function redCards()
    {
        return $this->stats()->where('stat', 'red_cards');
    }

    public function getManagerAttribute()
    {
        return in_array($this?->currentContract?->type, [ContractType::Manager, ContractType::CoManager]);
    }


}
