<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Motor - Selamat Datang</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <style>
        .animate-fade-in { animation: fadeIn 1.2s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: none; } }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-[#1e293b] via-[#312e81] to-[#7c3aed] text-white">
    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <div class="relative w-full max-w-xl p-10 rounded-3xl shadow-2xl bg-white/20 backdrop-blur-xl border border-white/30 animate-fade-in">
            <!-- Icon Premium -->
            <div class="absolute -top-14 left-1/2 -translate-x-1/2 bg-gradient-to-tr from-[#7c3aed] to-[#fbbf24] p-5 rounded-full shadow-xl border-4 border-white/40">
                <img src="https://img.icons8.com/ios-filled/100/ffffff/motorcycle.png" alt="Premium Logo" class="w-16 h-16 drop-shadow-xl">
            </div>
            <!-- Title -->
            <div class="mt-10 mb-8 text-center">
                <h1 class="text-5xl font-black text-white drop-shadow-lg tracking-wide">Rental Motor</h1>
                <p class="text-xl text-white/80 mt-2 font-medium">Solusi sewa motor yang mewah, mudah, dan cepat</p>
            </div>
            <!-- Auth Buttons -->
            @if (Route::has('login'))
                <div class="flex flex-col space-y-4 mt-8">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full py-3 px-4 rounded-xl font-bold bg-gradient-to-r from-[#7c3aed] via-[#fbbf24] to-[#312e81] text-white shadow-xl hover:scale-105 transition-all duration-300">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-3 px-4 rounded-xl font-bold bg-gradient-to-r from-red-500 to-pink-600 text-white shadow-xl hover:scale-105 transition-all duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="w-full py-3 px-4 rounded-xl font-bold bg-gradient-to-r from-[#7c3aed] via-[#fbbf24] to-[#312e81] text-white shadow-xl hover:scale-105 transition-all duration-300">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full py-3 px-4 rounded-xl font-bold bg-gradient-to-r from-gray-500 to-slate-600 text-white shadow-xl hover:scale-105 transition-all duration-300">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <!-- Footer -->
            <div class="mt-12 text-center text-white/60 text-sm">
                &copy; {{ date('Y') }} Rental Motor. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>

        <!-- Footer -->
        <p class="mt-8 text-sm text-gray-200">
            &copy; {{ date('Y') }} Sistem Penyewaan Motor. All rights reserved.
        </p>
    </div>
</body>
</html>
