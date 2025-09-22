@extends('layouts.app')
@section('content')
<h2>Histori Penyewaan</h2>
<table border="1" cellpadding="5">
  <tr>
    <th>ID</th><th>Motor</th><th>Periode</th><th>Harga</th><th>Status</th><th>Pembayaran</th>
  </tr>
  @foreach($bookings as $b)
  <tr>
    <td>{{ $b->id }}</td>
    <td>{{ $b->motor->brand }} ({{ $b->motor->plate_number }})</td>
    <td>{{ $b->start_date->format('d M Y') }} - {{ $b->end_date->format('d M Y') }}</td>
    <td>Rp {{ number_format($b->price) }}</td>
    <td>{{ $b->status }}</td>
    <td>{{ $b->payment? $b->payment->status : '-' }}</td>
  </tr>
  @endforeach
</table>
{{ $bookings->links() }}
@endsection
