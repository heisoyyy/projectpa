@extends('home.komponen.login')

@section('title', 'Verifikasi Email')

@section('content')
<div class="login-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-card">
                    <h2 class="text-center">Verifikasi Email</h2>
                    <p class="text-center">Masukkan kode OTP yang dikirim ke email: <strong>{{ $email }}</strong></p>

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('verify.otp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="form-group">
                            <label for="otp_code">Kode OTP</label>
                            <input type="text" name="otp_code" id="otp_code" class="form-control" required maxlength="6">
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn-login">Verifikasi</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection