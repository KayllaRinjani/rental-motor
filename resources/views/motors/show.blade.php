@extends('layouts.app')
@section('content')
<h2>{{ $motor->brand }} - {{ $motor->type_cc }}</h2>
<img src="{{ $motor->photo ? asset('storage/'.$motor->photo) : 'https://via.placeholder.com/200' }}" width="200">
<p>Plat: {{ $motor->plate_number }}</p>
<p>Status: {{ $motor->status }}</p>

@if($motor->rentalRate)
  <p>Harga: Harian Rp {{ number_format($motor->rentalRate->daily_rate) }},
     Mingguan Rp {{ number_format($motor->rentalRate->weekly_rate) }},
     Bulanan Rp {{ number_format($motor->rentalRate->monthly_rate) }}</p>
@endif

@if(auth()->check() && auth()->user()->role === 'penyewa')
<form action="{{ route('bookings.store') }}" method="POST">
  @csrf
  <input type="hidden" name="motor_id" value="{{ $motor->id }}">
  <label>Mulai: <input type="date" name="start_date" required></label>
  <label>Selesai: <input type="date" name="end_date" required></label>
  <label>Durasi:
    <select name="duration_type">
      <option value="daily">Harian</option>
      <option value="weekly">Mingguan</option>
      <option value="monthly">Bulanan</option>
    </select>
  </label>
  <button type="submit">Booking</button>
</form>
@endif
@endsection
