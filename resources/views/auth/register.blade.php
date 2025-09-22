<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1e293b] via-[#312e81] to-[#7c3aed]">
        <div class="relative w-full max-w-md p-8 rounded-3xl shadow-2xl bg-white/20 backdrop-blur-xl border border-white/30 animate-fade-in">
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-gradient-to-tr from-[#7c3aed] to-[#fbbf24] p-4 rounded-full shadow-xl border-4 border-white/40">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/motorcycle.png" alt="Premium Logo" class="w-12 h-12 drop-shadow-xl">
            </div>
            <div class="text-center mb-8 mt-8">
                <h1 class="text-4xl font-black text-white drop-shadow-lg tracking-wide">Register Akun</h1>
                <p class="text-lg text-white/80 mt-2 font-medium">Daftar untuk pengalaman sewa motor terbaik</p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="'Nama Lengkap'" class="text-white font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-yellow-200" />
                </div>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="'Email'" class="text-white font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-200" />
                </div>
                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="'Password'" class="text-white font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-200" />
                </div>
                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" class="text-white font-semibold" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-yellow-200" />
                </div>
                <!-- Role -->
                <div>
                    <x-input-label for="role" :value="'Pilih Role'" class="text-white font-semibold" />
                    <select id="role" name="role" required class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="owner">Owner</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-yellow-200" />
                </div>
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-yellow-200 hover:text-white underline transition" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>
                    <button type="submit" class="py-3 px-6 bg-gradient-to-r from-[#7c3aed] via-[#fbbf24] to-[#312e81] text-white font-bold rounded-xl shadow-xl hover:scale-105 transition-all duration-300">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
