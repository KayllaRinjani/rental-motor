
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-200 via-green-400 to-green-600">
    <div class="bg-white/80 rounded-2xl shadow-2xl p-10 w-full max-w-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-green-700 mb-2">Dashboard Pemilik</h1>
            <p class="text-gray-700">Selamat datang, <span class="font-bold">{{ auth()->user()->name }}</span>!</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-green-100 rounded-xl p-6 shadow text-center">
                <h3 class="text-lg font-bold text-green-700 mb-2">Total Motor Anda</h3>
                <div class="text-2xl font-extrabold text-green-800">{{ auth()->user()->motors->count() }}</div>
            </div>
            <div class="bg-green-100 rounded-xl p-6 shadow text-center">
                <h3 class="text-lg font-bold text-green-700 mb-2">Total Booking</h3>
                <div class="text-2xl font-extrabold text-green-800">{{ auth()->user()->bookings->count() }}</div>
            </div>
        </div>
        <div class="flex justify-center gap-4">
            <a href="{{ route('owner.motors.index') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">Kelola Motor</a>
            <a href="{{ route('owner.revenue') }}" class="px-6 py-3 bg-yellow-500 text-white rounded-lg font-semibold shadow hover:bg-yellow-600 transition">Lihat Pendapatan</a>
        </div>
    </div>
</div>
@endsection