@extends('home.komponen.login')

@section('title', 'Login - LKBB Komando')

@section('content')
<div class="login-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="login-card">

          <!-- Logo -->
          <div class="text-center mb-3">
            <img src="{{ asset('assets/images/Logo.jpg') }}" alt="Logo" class="login-logo">
          </div>

          <h2 class="text-center">Login</h2>
          <p class="text-center">Silakan masuk untuk melanjutkan</p>

          <!-- Flash Message -->
          @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <!-- Error Validation -->
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <!-- Form Login -->
          <form action="{{ route('login.post') }}" method="POST" class="login-form">
            @csrf

            <!-- Email -->
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required>
            </div>

            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- Password -->
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                required>
            </div>


            <!-- Tombol Login -->
            <div class="text-center">
              <button type="submit" class="btn-login">
                <i class="fa fa-sign-in"></i> Login
              </button>
            </div>
          </form>

          <div class="text-center mt-3">
            <small>Belum punya akun? <a href="{{ route('register.form') }}">Daftar di sini</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection