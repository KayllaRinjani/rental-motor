@extends('layouts.app')
@section('content')
<h2>Booking #{{ $booking->id }}</h2>
<p>Motor: {{ $booking->motor->brand }} - {{ $booking->motor->plate_number }}</p>
<p>Periode: {{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}</p>
<p>Harga: Rp {{ number_format($booking->price,0,',','.') }}</p>

@if($booking->payment)
  <p>Status Pembayaran: {{ $booking->payment->status }}</p>
  @if($booking->payment->status === 'pending')
    <form action="{{ route('payments.upload', $booking->payment->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <label>Unggah bukti transfer (jpg/png): <input type="file" name="proof" required></label>
      <button type="submit">Unggah</button>
    </form>
  @endif
  @if($booking->payment->proof)
    <p>Bukti: <a href="{{ asset('storage/'.$booking->payment->proof) }}" target="_blank">Lihat</a></p>
  @endif
@else
  <p>Tidak ada pembayaran terdaftar.</p>
@endif
@endsection
