@extends('.user.komponen.user-komponen')

@section('title', 'Hasil Peserta')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4 shadow-sm">
                <h6 class="mb-4">Hasil Lomba LKBB Komando</h6>

                <!-- Info -->
                <div class="alert alert-success d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa fa-trophy"></i> Hasil lomba telah diumumkan!
                    </div>
                    <div>
                        <strong>Tanggal:</strong> {{ now()->format('d F Y') }}
                    </div>
                </div>

                <!-- Tabel Hasil -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Peringkat</th>
                                <th>Sekolah</th>
                                <th>Nilai</th>
                                <th>Status Juara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasil as $row)
                                @php
                                    $badge = '-';
                                    if($row->peringkat == 1) {
                                        $badge = '<span class="badge bg-warning text-dark"><i class="fa fa-crown"></i> Juara 1</span>';
                                    } elseif($row->peringkat == 2) {
                                        $badge = '<span class="badge bg-secondary"><i class="fa fa-medal"></i> Juara 2</span>';
                                    } elseif($row->peringkat == 3) {
                                        $badge = '<span class="badge bg-info text-dark"><i class="fa fa-award"></i> Juara 3</span>';
                                    }
                                @endphp
                                <tr class="{{ $row->peringkat == 1 ? 'table-warning' : ($row->peringkat == 2 ? 'table-secondary' : ($row->peringkat == 3 ? 'table-info' : '')) }}">
                                    <td>{{ $row->peringkat }}</td>
                                    <td>{{ $row->team->user->nama_sekolah ?? '-' }}</td>
                                    <td>{{ number_format($row->total, 2) }}</td>
                                    <td>{!! $badge !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                <!-- Highlight Tim User -->
                @if($userTeam)
                    @php
                        $myResult = $hasil->firstWhere('team_id', $userTeam->id);
                    @endphp

                    @if($myResult)
                        <div class="alert mt-3 alert-info">
                            <i class="fa fa-flag"></i> Sekolah Anda: 
                            <strong>{{ $myResult->team->user->nama_sekolah }}</strong> 
                            berada di <strong>Peringkat {{ $myResult->peringkat }}</strong> 
                            dengan nilai <strong>{{ number_format($myResult->total, 2) }}</strong>.
                        </div>
                    @else
                        <div class="alert mt-3 alert-warning">
                            <i class="fa fa-info-circle"></i> Nilai sekolah Anda belum tersedia.
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
