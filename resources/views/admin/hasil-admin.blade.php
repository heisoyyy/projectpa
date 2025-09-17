@extends('admin.komponen.komponen')
@section('title','Hasil Lomba Admin')
@section('content')

<h3 class="mb-4">Input & Lihat Hasil Lomba</h3>

<!-- Tombol Tambah Nilai -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahHasilModal">
  + Tambah Nilai
</button>

<!-- Modal Tambah Nilai -->
<div class="modal fade" id="tambahHasilModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Nilai Tim</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.hasil-admin.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label>Sekolah</label>
            <select name="team_id" class="form-select" id="teamSelect" required>
              <option value="">-- Pilih Sekolah --</option>
              @foreach($teams as $team)
                @php
                  $sudahInput = $hasils->pluck('team_id')->contains($team->id);
                @endphp
                <option value="{{ $team->id }}" @if($sudahInput) disabled style="display:none" @endif>
                  {{ $team->user->nama_sekolah ?? '-' }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Input Nilai 0-100, maksimal 3 digit -->
          <div class="mb-3"><label>Nilai Baris</label><input type="number" name="nilai_baris" class="form-control nilai-input" min="0" max="100" required></div>
          <div class="mb-3"><label>Nilai Variasi</label><input type="number" name="nilai_variasi" class="form-control nilai-input" min="0" max="100" required></div>
          <div class="mb-3"><label>Nilai Formasi</label><input type="number" name="nilai_formasi" class="form-control nilai-input" min="0" max="100" required></div>
          <div class="mb-3"><label>Nilai Kompak</label><input type="number" name="nilai_kompak" class="form-control nilai-input" min="0" max="100" required></div>

          <div class="mb-3"><label>Catatan</label><textarea name="catatan" class="form-control"></textarea></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tabel Hasil -->
<table class="table table-bordered table-striped">
  <thead class="table-primary">
    <tr>
      <th>No</th>
      <th>Sekolah</th>
      <th>Nilai Baris</th>
      <th>Nilai Variasi</th>
      <th>Nilai Formasi</th>
      <th>Nilai Kompak</th>
      <th>Total</th>
      <th>Catatan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($hasils as $i => $hasil)
      <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $hasil->team->user->nama_sekolah ?? '-' }}</td>
        <td>{{ $hasil->nilai_baris }}</td>
        <td>{{ $hasil->nilai_variasi }}</td>
        <td>{{ $hasil->nilai_formasi }}</td>
        <td>{{ $hasil->nilai_kompak }}</td>
        <td>{{ number_format($hasil->total,2) }}</td>
        <td>{{ $hasil->catatan ?? '-' }}</td>
        <td>
          <!-- Edit -->
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editHasilModal{{ $hasil->id }}">
              Edit
          </button>

          <!-- Modal Edit -->
          <div class="modal fade" id="editHasilModal{{ $hasil->id }}" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                  <h5 class="modal-title">Edit Nilai: {{ $hasil->team->user->nama_sekolah }}</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.hasil-admin.update', $hasil->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="modal-body">
                    <div class="mb-3"><label>Nilai Baris</label><input type="number" name="nilai_baris" class="form-control nilai-input" min="0" max="100" value="{{ $hasil->nilai_baris }}" required></div>
                    <div class="mb-3"><label>Nilai Variasi</label><input type="number" name="nilai_variasi" class="form-control nilai-input" min="0" max="100" value="{{ $hasil->nilai_variasi }}" required></div>
                    <div class="mb-3"><label>Nilai Formasi</label><input type="number" name="nilai_formasi" class="form-control nilai-input" min="0" max="100" value="{{ $hasil->nilai_formasi }}" required></div>
                    <div class="mb-3"><label>Nilai Kompak</label><input type="number" name="nilai_kompak" class="form-control nilai-input" min="0" max="100" value="{{ $hasil->nilai_kompak }}" required></div>
                    <div class="mb-3"><label>Catatan</label><textarea name="catatan" class="form-control">{{ $hasil->catatan }}</textarea></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Delete -->
          <form action="{{ route('admin.hasil-admin.destroy', $hasil->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus nilai ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- JS untuk batasi input maksimal 3 digit dan <= 100 -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const inputs = document.querySelectorAll('.nilai-input');
  inputs.forEach(input => {
    input.addEventListener('input', function() {
      if(this.value > 100) this.value = 100;
      if(this.value.length > 3) this.value = this.value.slice(0,3);
      if(this.value < 0) this.value = 0;
    });
  });
});
</script>

@endsection
