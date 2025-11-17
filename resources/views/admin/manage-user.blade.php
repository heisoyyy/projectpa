@extends('admin.komponen.komponen')

@section('title', 'Kelola Admin & Juri')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Kelola Admin & Juri</h3>

    {{-- Button Tambah --}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        + Tambah Admin/Juri
    </button>

    {{-- Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $user->nama_sekolah }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-success">Juri</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus?')" 
                                    class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                                    @csrf @method('PUT')

                                    <div class="modal-header">
                                        <h5>Edit User</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <label>Nama</label>
                                        <input type="text" class="form-control mb-2" name="nama"
                                            value="{{ $user->nama_sekolah }}">

                                        <label>Email</label>
                                        <input type="email" class="form-control mb-2" name="email"
                                            value="{{ $user->email }}">

                                        <label>Role</label>
                                        <select name="role" class="form-control mb-2">
                                            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                            <option value="juri" {{ $user->role=='juri'?'selected':'' }}>Juri</option>
                                        </select>

                                        <label>Password (opsional)</label>
                                        <input type="password" name="password" class="form-control mb-2">
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.storeUser') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5>Tambah Admin / Juri</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>Nama</label>
                    <input type="text" class="form-control mb-2" name="nama" required>

                    <label>Email</label>
                    <input type="email" class="form-control mb-2" name="email" required>

                    <label>Role</label>
                    <select name="role" class="form-control mb-2" required>
                        <option value="admin">Admin</option>
                        <option value="juri">Juri</option>
                    </select>

                    <label>Password</label>
                    <input type="password" class="form-control mb-2" name="password" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Tambah</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
