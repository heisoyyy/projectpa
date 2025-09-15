@extends('user.komponen.layout')

@section('content')
<h3>{{ $pesan->judul }}</h3>
<p>{{ $pesan->isi }}</p>
<small class="text-muted">Dikirim pada: {{ $pesan->created_at->format('d-m-Y H:i') }}</small>
<br>
<a href="{{ route('user.pesan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection