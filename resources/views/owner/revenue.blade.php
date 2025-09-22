@extends('layouts.app')
@section('content')
<h2>Laporan Bagi Hasil</h2>
<p><strong>Total Pendapatan:</strong> Rp {{ number_format($total) }}</p>
<table border="1" cellpadding="5">
  <tr><th>Booking</th><th>Motor</th><th>Owner Share</th><th>Admin Share</th><th>Tanggal</th></tr>
  @foreach($revenues as $r)
  <tr>
    <td>#{{ $r->booking->id }}</td>
    <td>{{ $r->booking->motor->brand }} ({{ $r->booking->motor->plate_number }})</td>
    <td>Rp {{ number_format($r->owner_share) }}</td>
    <td>Rp {{ number_format($r->admin_share) }}</td>
    <td>{{ $r->settled_at? $r->settled_at->format('d M Y') : '-' }}</td>
  </tr>
  @endforeach
</table>
{{ $revenues->links() }}
@endsection
