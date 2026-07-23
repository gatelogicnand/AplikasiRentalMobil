<!-- Menentukan layout secara dinamis berdasarkan role user -->
@php
    $layoutName = Auth::user()->role === 'admin' ? 'admin-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layoutName">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Card 1: Informasi Profil -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl transition-shadow hover:shadow-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Card 2: Ubah Password -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl transition-shadow hover:shadow-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Card 3: Hapus Akun -->
            <div class="p-6 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl transition-shadow hover:shadow-md">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-dynamic-component>