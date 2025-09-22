@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-green-600 to-green-700 text-white flex flex-col p-6 shadow-lg">
        <div class="flex items-center mb-8">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/motorcycle.png" class="w-10 h-10 mr-3" alt="Logo">
            <span class="font-bold text-xl">Rental Motor</span>
        </div>
        <nav class="flex-1">
            <ul class="space-y-2">
                <li><a href="#" class="flex items-center px-3 py-2 rounded bg-green-800"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 8h2v-2H7v2zm0-4h2v-2H7v2zm0-8h2V7H7v2zm4 8h2v-2h-2v2zm0-4h2v-2h-2v2zm0-8h2V7h-2v2zm4 8h2v-2h-2v2zm0-4h2v-2h-2v2zm0-8h2V7h-2v2z"/></svg>Dashboard</a></li>
                <li><a href="{{ route('motors.index') }}" class="flex items-center px-3 py-2 rounded hover:bg-green-800"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>Lihat Motor</a></li>
                <li><a href="#" class="flex items-center px-3 py-2 rounded hover:bg-green-800"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 17l4-4-4-4m8 8V7"/></svg>Riwayat Booking</a></li>
            </ul>
        </nav>
        <div class="mt-8">
            <div class="flex items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=7c3aed&color=fff" class="w-10 h-10 rounded-full mr-2" alt="User">
                <div>
                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-green-200">{{ auth()->user()->role }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                <span class="text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('motors.index') }}" method="GET" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari motor..." class="w-full px-4 py-2 rounded-l-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-r-lg hover:bg-green-700 transition">Cari</button>
            </form>
        </div>

        <!-- Card Motor -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($motors as $motor)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $motor->image ? asset('storage/'.$motor->image) : 'https://img.icons8.com/ios-filled/200/motorcycle.png' }}" class="w-full h-40 object-cover" alt="{{ $motor->name }}">
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800">{{ $motor->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $motor->brand }}</p>
                    <p class="mt-2 text-green-600 font-semibold">Rp {{ number_format($motor->price,0,',','.') }}/hari</p>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('motors.show', $motor->id) }}" class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Detail</a>
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="motor_id" value="{{ $motor->id }}">
                            <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">Sewa</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <p class="col-span-3 text-center text-gray-500">Motor tidak tersedia.</p>
        @extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-green-600 to-green-700 text-white flex flex-col p-6 shadow-xl">
        <!-- Logo -->
        <div class="flex items-center mb-10">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/motorcycle.png" class="w-10 h-10 mr-3" alt="Logo">
            <span class="font-extrabold text-xl tracking-wide">Rental Motor</span>
        </div>
        <!-- Menu -->
        <nav class="flex-1">
            <ul class="space-y-3">
                <li>
                    <a href="#" class="flex items-center px-3 py-2 rounded-lg bg-green-800 shadow hover:shadow-md transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zM7 17h2v-2H7v2zm0-4h2v-2H7v2zM7 9h2V7H7v2z"/>
                        </svg>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('motors.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-green-800 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>Lihat Motor
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-green-800 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 17l4-4-4-4m8 8V7"/>
                        </svg>Riwayat Booking
                    </a>
                </li>
            </ul>
        </nav>
        <!-- User Info -->
        <div class="mt-10 flex items-center border-t border-green-500 pt-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=22c55e&color=fff" 
                 class="w-10 h-10 rounded-full mr-3 shadow-lg" alt="User">
            <div>
                <div class="font-semibold">{{ auth()->user()->name }}</div>
                <div class="text-xs text-green-200 capitalize">{{ auth()->user()->role }}</div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-wide">Dashboard</h1>
                <p class="text-gray-500">Selamat datang kembali, <span class="font-semibold">{{ auth()->user()->name }}</span></p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-8">
            <form action="{{ route('motors.index') }}" method="GET" class="flex shadow-lg rounded-lg overflow-hidden">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="🔍 Cari motor sesuai kebutuhan Anda..." 
                       class="w-full px-4 py-2 border-0 focus:ring-2 focus:ring-green-500 focus:outline-none">
                <button type="submit" 
                        class="bg-green-600 text-white px-6 py-2 font-semibold hover:bg-green-700 transition">
                    Cari
                </button>
            </form>
        </div>

        <!-- Card Motor -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($motors as $motor)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition p-4">
                <div class="relative">
                    <img src="{{ $motor->image ? asset('storage/'.$motor->image) : 'https://img.icons8.com/ios-filled/200/motorcycle.png' }}" 
                         class="w-full h-48 object-cover rounded-lg" alt="{{ $motor->name }}">
                    <span class="absolute top-2 left-2 px-3 py-1 text-xs font-bold rounded-full 
                                 {{ $motor->status == 'available' ? 'bg-green-500 text-white' : ($motor->status == 'unavailable' ? 'bg-red-500 text-white' : 'bg-yellow-400 text-black') }}">
                        {{ ucfirst($motor->status) }}
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $motor->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $motor->brand }}</p>
                    <p class="mt-2 text-green-600 font-bold text-lg">Rp {{ number_format($motor->price,0,',','.') }}/hari</p>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('motors.show', $motor->id) }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm shadow">
                            Detail
                        </a>
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="motor_id" value="{{ $motor->id }}">
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm shadow">
                                Sewa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <p class="col-span-3 text-center text-gray-500">❌ Motor tidak tersedia untuk saat ini.</p>
            @endforelse
        </div>
    </main>
</div>
@endsection
    @endforelse
        </div>
    </main>
</div>
@endsection
