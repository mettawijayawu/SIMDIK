// app/Http/Middleware/CheckUserStatus.php

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $requiredStatus (e.g., 'guru', 'admin')
     */
    public function handle(Request $request, Closure $next, string $requiredStatus = 'user'): Response
    {
        // 1. Pastikan pengguna sudah login
        if (!Auth::check()) {
            // Redirect ke halaman login admin (jika dari rute admin) atau halaman login umum
            return redirect()->route('admin.login'); 
        }

        $user = Auth::user();

        // 2. Logika otorisasi
        if ($requiredStatus === 'guru' && $user->status !== 'guru' && $user->status !== 'admin') {
            abort(403, 'Akses Terlarang: Anda bukan seorang guru atau admin.');
        }

        if ($requiredStatus === 'admin' && $user->status !== 'admin') {
             abort(403, 'Akses Terlarang: Anda bukan seorang admin.');
        }
        
        return $next($request);
    }
}