<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * Cek apakah pengguna saat ini memiliki role 'admin'.
     */
    public function isAdmin(): bool
    {
        // Cek apakah nilai kolom status sama dengan 'admin'
        return $this->status === 'admin'; 
    }

    public function isTeacher(): bool
    {
        // Cek apakah nilai kolom status sama dengan 'teacher'
        return $this->status === 'guru'; 
    }

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Dapatkan nama bidang yang digunakan untuk login (Authentication Field).
     * Ini akan menimpa kolom 'email' default Laravel.
     *
     * @return string
     */
    public function username() // <-- 2. TAMBAHKAN METODE INI
    {
        return 'username';
    }
}
