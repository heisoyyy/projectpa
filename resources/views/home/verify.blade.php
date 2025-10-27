@extends('home.komponen.login')

@section('title', 'Verifikasi OTP - LKBB Komando')

@section('content')

@php
    $user = \App\Models\User::where('email', $email)->first();
@endphp

@if($user && $user->is_verified)
    <script>
        window.location.href = "{{ route('login.form') }}";
    </script>
@endif

<div class="login-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-card">
                    <h3 class="text-center mb-3">Verifikasi Akun</h3>
                    <p class="text-center text-muted mb-3">Masukkan kode OTP yang dikirim ke email <strong>{{ $email }}</strong></p>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('verify.otp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group mb-3">
                            <label for="otp_code">Kode OTP</label>
                            <input type="text" id="otp_code" name="otp_code" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-login w-100">Verifikasi</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small><a href="{{ route('otp.resend.form') }}">Kirim ulang OTP</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
