@extends('juri.komponen.komponen')

@section('title', 'Jadwal Juri')

@section('content')

<h2 class="mb-4 mt-4">Atur Jadwal Lomba</h2>

<!-- Tabel Jadwal -->
<table class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>No</th>
      <th>Tim</th>
      <th>Urutan</th>
      <th>Tanggal</th>
      <th>Waktu</th>
      <th>Tempat</th>
    </tr>
  </thead>
  <tbody class="text-center">
    @foreach($jadwals as $i => $jadwal)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $jadwal->team->nama_tim }}</td>
      <td>{{ $jadwal->urutan }}</td>
      <td>{{ Carbon\Carbon::parse($jadwal->tanggal)->format('d F Y') }}</td>
      <td>{{ Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
      <td>{{ $jadwal->tempat }}</td>
    </tr>
    @endforeach
  </tbody>

</table>
@endsection