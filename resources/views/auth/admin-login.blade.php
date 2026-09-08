<x-guest-layout>
            <style>
        body {
        min-height: 70vh;
        background-image: url('{{ asset('img/smm.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;"
    }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- ACTION KE ROUTE KHUSUS ADMIN --}}
        <form method="POST" action="{{ route('admin.login.attempt') }}"> 
            @csrf
            <h1 style="align-self: center; text-align: center; font-size: 30px; 
        font-weight: 600; margin-top: 5px">
                LOGIN ADMIN
            </h1>
            <div>
                <x-input-label for="username" :value="__('Username')" />

                <x-text-input id="username" class="block mt-1 w-full dark:bg-white-900" type="text" name="username"
                    :value="old('username')" required autofocus autocomplete="off" />

                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <div class="relative flex items-center">
                    <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                        autocomplete="current-password" />

                    <button type="button" id="togglePassword"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 
                                 flex items-center px-3 mt-1 text-gray-900 hover:text-gray-900 
                                 focus:outline-none">
                        <i id="eye-icon" class="fa-solid fa-eye-slash text-lg"></i>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-white dark:bg-white border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-white"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-900">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    {{-- Link Forgot Password tetap dipertahankan --}}
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                {{-- HILANGKAN LINK REGISTER --}}

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <script>
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (togglePassword && passwordInput && eyeIcon) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    if (type === 'text') {
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            }
        </script>

        <script>
            @if (session('status'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: @json(session('status'))
                });
            @endif
        </script>
    </x-guest-layout>