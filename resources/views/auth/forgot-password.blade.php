@extends('auth.komponen.login')

@section('title', 'Lupa Password')

@section('content')
<div class="login-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="login-card">
                    <div class="text-center mb-3">
                        <img src="{{ asset('assets/images/Logo.jpg') }}" alt="Logo" class="login-logo">
                    </div>
                    <h3 class="text-center mb-3">Lupa Password</h3>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Anda</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn-login">
                                <i class="fa fa-paper-plane"></i> Kirim Link Reset
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection