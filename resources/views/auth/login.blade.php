<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1e293b] via-[#312e81] to-[#7c3aed]">
        <div class="relative w-full max-w-md p-8 rounded-3xl shadow-2xl bg-white/20 backdrop-blur-xl border border-white/30 animate-fade-in">
            <!-- Icon Premium -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-gradient-to-tr from-[#7c3aed] to-[#fbbf24] p-4 rounded-full shadow-xl border-4 border-white/40">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/motorcycle.png" alt="Premium Logo" class="w-12 h-12 drop-shadow-xl">
            </div>
            <!-- Judul -->
            <div class="text-center mb-8 mt-8">
                <h1 class="text-4xl font-black text-white drop-shadow-lg tracking-wide">Rental Motor</h1>
                <p class="text-lg text-white/80 mt-2 font-medium">Masuk untuk pengalaman sewa motor terbaik</p>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="'Email'" class="text-white font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-200" />
                </div>
                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="'Password'" class="text-white font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-xl border-none bg-white/60 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#7c3aed] focus:bg-white/80 transition" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-200" />
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
                <!-- Remember Me & Forgot -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center text-white/80">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#7c3aed] focus:ring-[#7c3aed]" name="remember">
                        <span class="ml-2 text-sm">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-yellow-200 hover:text-white underline transition" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <!-- Submit -->
                <div>
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-[#7c3aed] via-[#fbbf24] to-[#312e81] text-white font-bold rounded-xl shadow-xl hover:scale-105 hover:from-[#312e81] hover:to-[#7c3aed] transition-all duration-300">
                        Log in
                    </button>
                </div>
            </form>
            <div class="mt-8 text-center">
                <span class="text-white/80">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="ml-2 text-yellow-200 font-bold hover:text-white underline transition">Register</a>
            </div>
        </div>
    </div>
</x-guest-layout>
