<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    // ========================================================================
    // LOGIKA OTENTIKASI (LOGIN KHUSUS) - Digunakan untuk URL /admin
    // ========================================================================

    /**
     * Tampilkan form login Admin (URL: /admin) atau redirect ke dashboard jika sudah login.
     */
    public function create()
    {
        // 1. Cek Sesi: Apakah user sudah login?
        if (Auth::check()) {
            $user = Auth::user();

            // 2. Redirect berdasarkan status (Admin/Teacher)
            if ($user->status === 'admin') {
                // Jika Admin, redirect ke Admin Dashboard
                return redirect()->route('admin.dashboard');
            } elseif ($user->status === 'guru') {
                // Jika Teacher, redirect ke Teacher Dashboard
                return redirect()->route('teacher.dashboard');
            } else {
                // Jika User biasa, redirect ke Dashboard User biasa
                return redirect()->route('dashboard'); 
            }
        }
        
        // Jika belum login, tampilkan form
        return view('auth.admin-login'); 
    }

    /**
     * Tangani proses otentikasi (login) Admin/Teacher.
     */
    public function store(LoginRequest $request)
    {
        // 1. Lakukan otentikasi standar (validasi kredensial)
        $request->authenticate();

        // 2. Ambil user yang berhasil diautentikasi
        $user = Auth::user();

        // 3. Cek apakah user memiliki status 'admin' atau 'guru'
        if ($user && ($user->status === 'admin' || $user->status === 'guru')) {
            
            // Otentikasi dan sesi berhasil
            $request->session()->regenerate();
            
            // Redirect ke dashboard yang sesuai berdasarkan status
            if ($user->status === 'admin') {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            } else { // status 'guru'
                return redirect()->intended(route('teacher.dashboard', absolute: false));
            }
        }

        // 4. Jika otentikasi berhasil, tetapi statusnya BUKAN admin/guru (user biasa),
        //    maka user harus di-logout karena mencoba login di rute khusus
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Lempar error untuk form login khusus
        throw ValidationException::withMessages([
            'username' => trans('Anda Bukan Guru/Admin'), 
        ]);
    }

    // ... (Metode CRUD dan Dashboard lainnya)

    public function dashboard() { return view('admin.dashboard'); }
    public function dataUser() { $users = User::all(); return view('admin.datauser', compact('users')); }
    public function editUser(User $user) { return view('admin.data-user-edit', compact('user')); }
    public function updateUser(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'status' => ['required', 'string', Rule::in(['user', 'guru', 'admin'])], 
        ]);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'] ?? $user->username;
        $user->status = $validated['status'];
        if ($request->filled('password')) {
            $request->validate(['password' => 'nullable|string|min:8|confirmed']);
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.data-user')->with('success', 'Data pengguna berhasil diperbarui!');
    }
    public function destroyUser(User $user) {
        $user->delete();
        return redirect()->route('admin.data-user')->with('success', 'Pengguna berhasil dihapus.');
    }
}