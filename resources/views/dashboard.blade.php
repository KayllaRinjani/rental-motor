@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">📊 Dashboard Admin</h1>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <h5 class="text-gray-600">Total Motor</h5>
            <p class="text-2xl font-bold">{{ $totalMotors }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <h5 class="text-gray-600">Motor Disewa</h5>
            <p class="text-2xl font-bold">{{ $rentedMotors }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <h5 class="text-gray-600">Pendapatan Pemilik</h5>
            <p class="text-2xl font-bold">Rp {{ number_format($ownerShare) }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <h5 class="text-gray-600">Pendapatan Admin</h5>
            <p class="text-2xl font-bold">Rp {{ number_format($adminShare) }}</p>
        </div>
    </div>

    <!-- Shortcut Menu -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.motors.index') }}" class="bg-blue-600 text-white p-6 rounded-lg shadow hover:bg-blue-700">
            <h3 class="text-lg font-semibold">🚴 Kelola Motor</h3>
            <p>Verifikasi & kelola semua motor.</p>
        </a>
        <a href="{{ route('admin.reports.dashboard') }}" class="bg-green-600 text-white p-6 rounded-lg shadow hover:bg-green-700">
            <h3 class="text-lg font-semibold">📑 Laporan</h3>
            <p>Lihat ringkasan laporan penyewaan.</p>
        </a>
        <a href="#" class="bg-yellow-600 text-white p-6 rounded-lg shadow hover:bg-yellow-700">
            <h3 class="text-lg font-semibold">💰 Verifikasi Pembayaran</h3>
            <p>Konfirmasi atau tolak pembayaran.</p>
        </a>
    </div>

    <!-- Chart -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">📅 Penyewaan Per Bulan</h3>
        <canvas id="chart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bookingsPerMonth->keys()) !!},
            datasets: [{
                label: 'Jumlah Booking',
                data: {!! json_encode($bookingsPerMonth->values()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        }
    });
</script>
@endsection
