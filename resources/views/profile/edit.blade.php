<x-app-layout>
            <style>

        @media (max-width: 768px) {
            
            .footer {
                font-size: 0.6em;
            }
        }
        
    </style>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('Profile') }}

        </h2>

    </x-slot>



    <div class="py-12 bg-cover bg-center">

        <!-- PERBAIKAN DI SINI: Tambahkan px-4 sm:px-6 lg:px-8 untuk padding horizontal -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">

                    @include('profile.partials.update-password-form')

                </div>

            </div>



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xl">

                    @include('profile.partials.delete-user-form')

                </div>

            </div>



        </div>

    </div>

</x-app-layout>
