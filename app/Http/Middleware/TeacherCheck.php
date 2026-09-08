<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // <-- Pastikan namespace Response diimpor

class TeacherCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->isTeacher()) {
            return $next($request);
        }

        // Jika user tidak login atau bukan admin, arahkan kembali ke dashboard user biasa
        // Atau Anda bisa menggunakan abort(403) jika Anda ingin menampilkan halaman "Akses Ditolak"
        return redirect()->route('dashboard'); 
    }
}