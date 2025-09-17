@extends('user.komponen.komponen')

@section('title', 'Pesan')

@section('content')
@php
use Illuminate\Support\Str;
@endphp

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded p-4 shadow-sm">
                <h5 class="mb-4">📩 Pesan dari Admin</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesans as $i => $pesan)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><strong>{{ $pesan->judul }}</strong></td>
                                <td>{{ Str::limit($pesan->isi, 50) }}</td>
                                <td>{{ $pesan->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <!-- Tombol buka modal -->
                                    <button class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#pesanModal{{ $pesan->id }}">
                                        Buka
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal untuk detail pesan -->
                            <div class="modal fade" id="pesanModal{{ $pesan->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $pesan->judul }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $pesan->isi }}</p>
                                            <small class="text-muted">
                                                {{ $pesan->created_at->format('d-m-Y H:i') }}
                                            </small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <a href="{{ route('user.pesan.read', $pesan->id) }}" class="btn btn-primary">
                                                Buka Halaman
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada pesan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{ $pesans->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
