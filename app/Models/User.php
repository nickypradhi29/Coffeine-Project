<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
 
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
 
    // ─── Role Helpers ──────────────────────────────────────────────
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
 
    public function isKasir(): bool
    {
        return $this->role === 'kasir';
    }
 
    public function isMember(): bool
    {
        return $this->role === 'member';
    }
 
   // ─── Relationships ─────────────────────────────────────────────
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
    public function struks()
    {
        return $this->hasMany(Struk::class, 'kasir_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}