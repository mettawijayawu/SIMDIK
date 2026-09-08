<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // Tambahkan baris ini untuk menunjuk ke tabel 'status'
    protected $table = 'status'; 
    
    // Pastikan kolom untuk lookup di bawah ini ada di tabel status
    protected $fillable = ['status']; 
    public $timestamps = false; 

}