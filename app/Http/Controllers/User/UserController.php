<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Method untuk rute user.status-ppdb
    public function statusPPDB()
    {
        return view('user.status-ppdb');
    }
    
    // Tambahkan method lain sesuai kebutuhan
}