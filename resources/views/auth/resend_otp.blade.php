@extends('home.komponen.login')

@section('title', 'Kirim Ulang OTP - LKBB Komando')

@section('content')
<div class="login-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-card">
                    <div class="text-center mb-3">
                        <img src="{{ asset('assets/images/Logo.jpg') }}" alt="Logo" class="login-logo">
                    </div>

                    <h2 class="text-center mb-2">Kirim Ulang OTP</h2>
                    <p class="text-center text-muted mb-4">
                        Masukkan email yang kamu gunakan saat mendaftar untuk menerima kode OTP baru.
                    </p>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('otp.resend') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email kamu"
                                value="{{ old('email') }}"
                                required>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-login w-100">
                                <i class="fa fa-paper-plane"></i> Kirim Ulang Kode OTP
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small><a href="{{ route('login.form') }}">Kembali ke Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection