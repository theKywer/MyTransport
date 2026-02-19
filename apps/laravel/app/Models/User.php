<?php

namespace App\Models;

use App\Models\Transport\Transport;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'login',
        'firstname',
        'secondname',
        'family',
        'email',
        'phone',
        'birthday',
        'password'
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
            'birthday' => 'date',
            'password' => 'hashed',
        ];
    }

    /**
     * Get full name for user
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->family} {$this->firstname} {$this->secondname}");
    }

    /**
     * Behaviors for model {@see Transport}
     *
     * @return HasMany
     */
    public function transports(): HasMany
    {
        return $this->hasMany(Transport::class, 'user_id');
    }
}
