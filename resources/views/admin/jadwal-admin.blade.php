@extends('admin.komponen.komponen')

@section('title', 'Jadwal Admin')

@section('content')

<h2 class="mb-4 mt-4">Atur Jadwal Lomba</h2>

<!-- Tombol Tambah Jadwal -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
  + Tambah Jadwal
</button>

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="tambahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="tambahJadwalLabel">Tambah Jadwal Lomba</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="waktu" class="form-label">Waktu</label>
            <input type="time" name="waktu" id="waktu" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="tempat" class="form-label">Tempat</label>
            <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Contoh: GOR SMAN Plus" required>
          </div>
          <div class="mb-3">
            <label for="sekolah" class="form-label">Sekolah</label>
            <select name="sekolah_id" id="sekolah" class="form-select" required>
              <option value="">-- Pilih Sekolah --</option>
              @foreach($sekolahBelumJadwal as $team)
              <option value="{{ $team->id }}">{{ $team->user->nama_sekolah }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="urutan" class="form-label">Urutan</label>
            <input type="number" name="urutan" id="urutan" class="form-control" placeholder="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tabel Jadwal -->
<table class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Waktu</th>
      <th>Tempat</th>
      <th>Sekolah</th>
      <th>Urutan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody class="text-center">
    @foreach($jadwals as $i => $jadwal)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $jadwal->tanggal }}</td>
      <td>{{ $jadwal->waktu }}</td>
      <td>{{ $jadwal->tempat }}</td>
      <td>{{ $jadwal->team->user->nama_sekolah }}</td>
      <td>{{ $jadwal->urutan }}</td>
      <td>
        <!-- Tombol Edit -->
        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJadwalModal{{ $jadwal->id }}">
          Edit
        </button>

        <!-- Form Hapus -->
        <form action="{{ route('admin.jadwal.destroy',$jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>

</table>
@foreach($jadwals as $jadwal)
<div class="modal fade" id="editJadwalModal{{ $jadwal->id }}" tabindex="-1" aria-labelledby="editJadwalLabel{{ $jadwal->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title" id="editJadwalLabel{{ $jadwal->id }}">Edit Jadwal Lomba</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="tanggal{{ $jadwal->id }}" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal{{ $jadwal->id }}" class="form-control" value="{{ $jadwal->tanggal }}" required>
          </div>
          <div class="mb-3">
            <label for="waktu{{ $jadwal->id }}" class="form-label">Waktu</label>
            <input type="time" name="waktu" id="waktu{{ $jadwal->id }}" class="form-control" value="{{ $jadwal->waktu }}" required>
          </div>
          <div class="mb-3">
            <label for="tempat{{ $jadwal->id }}" class="form-label">Tempat</label>
            <input type="text" name="tempat" id="tempat{{ $jadwal->id }}" class="form-control" value="{{ $jadwal->tempat }}" required>
          </div>
          <div class="mb-3">
            <label for="sekolah{{ $jadwal->id }}" class="form-label">Sekolah</label>
            <select name="sekolah_id" id="sekolah{{ $jadwal->id }}" class="form-select" required>
              <option value="{{ $jadwal->team->id }}" selected>{{ $jadwal->team->user->nama_sekolah }}</option>
              @foreach($sekolahBelumJadwal as $team)
              <option value="{{ $team->id }}">{{ $team->user->nama_sekolah }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="urutan{{ $jadwal->id }}" class="form-label">Urutan</label>
            <input type="number" name="urutan" id="urutan{{ $jadwal->id }}" class="form-control" value="{{ $jadwal->urutan }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach


@endsection