<header class="header">
    <div class="header-left">
        <div class=" school-info">
            {{-- Mengubah style: Tambahkan 'width' atau ganti 'height: 100%;' --}}
            <a href="/"><img src="https://mettamaitreya.sch.id/assets/images/logo-header.png" alt="Logo Sekolah" style="width: auto;" class="logo"></a>
        </div>
    </div>
        <button class="login-button">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        {{-- LOGIKA BARU BERDASARKAN PERAN --}}
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                            style="color: white;">
                            Dashboard
                        </a>
                    @else
                        {{-- Jika belum login (Guest) --}}
                        <a href="{{ route('login') }}" style="color: white;">Login</a>
                    @endauth
                </div>
            @endif
        </button>
    </header>


