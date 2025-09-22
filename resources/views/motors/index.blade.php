
@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Cari Motor yang Tersedia</h2>
    <form method="GET" action="" class="flex items-center">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari merk, plat, cc..." class="px-4 py-2 rounded-l-lg border border-gray-300 focus:outline-none">
      <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg font-semibold hover:bg-indigo-700">Cari</button>
    </form>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($motors as $motor)
      <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col items-center">
        <img src="{{ $motor->photo ? asset('storage/'.$motor->photo) : 'https://via.placeholder.com/200x120?text=Motor' }}" class="w-full h-32 object-cover rounded mb-3">
        <h4 class="text-lg font-bold text-indigo-700 mb-1">{{ $motor->brand }} - {{ $motor->type_cc }}</h4>
        <p class="text-gray-600 mb-1">Plat: <span class="font-semibold">{{ $motor->plate_number }}</span></p>
        <a href="{{ route('motors.show',$motor) }}" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">Lihat Detail</a>
      </div>
    @empty
      <div class="col-span-3 text-center text-gray-500">Tidak ada motor ditemukan.</div>
    @endforelse
  </div>
  <div class="mt-8 flex justify-center">
    {{ $motors->links() }}
  </div>
</div>
@endsection
