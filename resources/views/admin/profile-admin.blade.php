@extends('.admin.komponen.admin-komponen')

@section('title', 'Profile Admin')

@section('content')

<h3 class="mb-4">Profile Admin</h3>

<div class="row">
  <!-- Info Profile -->
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <img src="{{ asset('images/default.png') }}" 
             class="rounded-circle mb-3" width="120" height="120" alt="Foto Profil">
        <h5>Nama Admin</h5>
        <p class="text-muted">admin@email.com</p>
      </div>
    </div>
  </div>

  <!-- Form Update Profile -->
  <div class="col-md-8">
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Update Profil</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" value="Nama Admin">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="admin@email.com">
          </div>
          <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" class="form-control" value="08123456789">
          </div>
          <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" class="form-control">
          </div>
          <button type="button" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
