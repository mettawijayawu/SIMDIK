<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;
    
    // Karena nama tabel Anda adalah 'tingkat' (singular) dan bukan 'tingkats' (plural), 
    // Anda perlu mendefinisikannya secara eksplisit.
    protected $table = 'tingkat'; 

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'tingkat', // Nama string tingkat (PAUD, SD, dll.)
    ];

    // Jika Anda ingin kolom 'tingkat' digunakan sebagai primary key:
    // protected $primaryKey = 'tingkat'; 
    // public $incrementing = false; 
}