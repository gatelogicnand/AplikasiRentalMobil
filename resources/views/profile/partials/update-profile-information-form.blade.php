<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
        <x-input-label for="foto_profil" :value="__('Foto Profile')" />
        
        <div class="mt-2 flex items-center gap-4">
            <!-- Preview Foto (Bentuk Bulat) -->
            <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 border border-gray-300 flex-shrink-0">
                @if(Auth::user()->foto_profil)
                    <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto Profile" class="w-full h-full object-cover">
                @else
                    <!-- Icon default jika belum ada foto -->
                    <svg class="w-full h-full text-gray-400 mt-2" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                @endif
            </div>
            
            <input id="foto_profil" name="foto_profil" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" />

            @if(Auth::user()->foto_profil)
                <div class="flex items-center mt-1">
                    <input id="hapus_foto" name="hapus_foto" type="checkbox" value="1" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                    <label for="hapus_foto" class="ml-2 text-sm font-medium text-red-600 cursor-pointer">Hapus foto saat ini</label>
                </div>
                @endif
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('foto_profil')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <script>
    // Menangkap elemen input file
    const inputFoto = document.getElementById('foto_profil');
    
    inputFoto.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Membaca file gambar yang dipilih
            const reader = new FileReader();
            reader.onload = function(e) {
                // Mencari div tempat foto berada (mengambil elemen pertama di atas input)
                const previewContainer = inputFoto.previousElementSibling;
                
                // Mengganti isi div dengan tag img yang memuat foto baru
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</section>
