@extends('home.komponen.home-ofc')

@section('title', 'LKBB Komando')

@section('content')

    {{-- ✅ Page Heading --}}
    <div class="page-heading header-text"
        style="background: url('{{ Storage::url($informasi->background) }}') no-repeat center center/cover; position: relative;">
        <div style="position:absolute;inset:0;background:rgba(80,0,0,0.55);"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <small  
                        style="color:rgba(255,255,255,0.7);letter-spacing:3px;text-transform:uppercase;font-size:13px;">LKBB
                        Komando</small>
                    <h3
                        style="color:#fff;font-weight:700;font-size:2.2rem;margin:6px 0 0;text-shadow:2px 2px 8px rgba(0,0,0,0.4);">
                        Hubungi Kami</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Contact Section --}}
    <div class="contact-page section py-5">
        <div class="container">

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-5 align-items-start">

                {{-- ✅ Kiri: Info Kontak --}}
                <div class="col-lg-5">
                    <div class="mb-4">
                        <span
                            style="color:#800000;font-weight:700;letter-spacing:2px;font-size:12px;text-transform:uppercase;">|
                            Kontak LKBB Komando</span>
                        <h2 class="fw-bold mt-2 mb-3" style="font-size:1.8rem;line-height:1.3;">Hubungi Kami <br>Jika Ada
                            Kendala</h2>
                        <div style="width:50px;height:4px;background:#800000;border-radius:2px;margin-bottom:1.2rem;"></div>
                        <p class="text-muted" style="line-height:1.8;font-size:0.95rem;text-align:justify;">
                            Organisasi Siswa Intra Sekolah (OSIS) SMAN Plus Provinsi Riau merupakan wadah resmi bagi siswa
                            untuk mengembangkan potensi diri, kepemimpinan, serta rasa tanggung jawab. Melalui OSIS, sekolah
                            menyelenggarakan LKBB Komando sebagai ajang penguatan karakter siswa.
                        </p>
                    </div>

                    {{-- Card Kontak --}}
                    <div class="d-flex flex-column gap-3">

                        {{-- Phone --}}
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 border"
                            style="background:#fff;box-shadow:0 2px 12px rgba(128,0,0,0.07);transition:all .3s;">
                            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                style="width:48px;height:48px;background:rgba(128,0,0,0.08);">
                                <i class="fa fa-phone" style="color:#800000;font-size:18px;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block"
                                    style="font-size:12px;letter-spacing:.5px;">TELEPON</small>
                                <span class="fw-bold" style="font-size:0.95rem;">0374 70562</span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 border"
                            style="background:#fff;box-shadow:0 2px 12px rgba(128,0,0,0.07);transition:all .3s;">
                            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                style="width:48px;height:48px;background:rgba(128,0,0,0.08);">
                                <i class="fa fa-envelope" style="color:#800000;font-size:18px;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size:12px;letter-spacing:.5px;">EMAIL</small>
                                <span class="fw-bold" style="font-size:0.95rem;">info@smanplus-propriau-sch.id</span>
                            </div>
                        </div>

                        {{-- Instagram --}}
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 border"
                            style="background:#fff;box-shadow:0 2px 12px rgba(128,0,0,0.07);transition:all .3s;">
                            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                style="width:48px;height:48px;background:rgba(128,0,0,0.08);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="#800000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                    <circle cx="12" cy="12" r="4" />
                                    <circle cx="17.5" cy="6.5" r="1" fill="#800000" stroke="none" />
                                </svg>
                            </div>
                            <div>
                                <small class="text-muted d-block"
                                    style="font-size:12px;letter-spacing:.5px;">INSTAGRAM</small>
                                <span class="fw-bold" style="font-size:0.95rem;">@smanplus_propriau</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ✅ Kanan: Form Kontak --}}
                <div class="col-lg-7">
                    <div class="p-4 p-lg-5 rounded-4 border"
                        style="background:#fff;box-shadow:0 8px 32px rgba(128,0,0,0.08);">

                        <h5 class="fw-bold mb-1" style="color:#800000;">Kirim Pesan</h5>
                        <p class="text-muted mb-4" style="font-size:0.9rem;">Isi formulir di bawah ini, kami akan merespons
                            secepatnya.</p>

                        <form id="contact-form" action="{{ route('contact.send') }}" method="post">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="font-size:0.88rem;">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required
                                        style="border-radius:8px;padding:10px 14px;font-size:0.9rem;">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="font-size:0.88rem;">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email" value="{{ old('email') }}" required
                                        style="border-radius:8px;padding:10px 14px;font-size:0.9rem;">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold" style="font-size:0.88rem;">Subject <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="subject" id="subject"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        placeholder="Masukkan subject pesan" value="{{ old('subject') }}" required
                                        style="border-radius:8px;padding:10px 14px;font-size:0.9rem;">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold" style="font-size:0.88rem;">Pesan <span
                                            class="text-danger">*</span></label>
                                    <textarea name="pesan" id="pesan" class="form-control @error('pesan') is-invalid @enderror"
                                        placeholder="Tuliskan pesan Anda di sini..." rows="5" required
                                        style="border-radius:8px;padding:10px 14px;font-size:0.9rem;resize:none;">{{ old('pesan') }}</textarea>
                                    @error('pesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn w-100 py-3 fw-bold"
                                        style="background:#800000;color:#fff;border-radius:8px;letter-spacing:.5px;font-size:0.95rem;transition:all .3s;border:none;">
                                        <i class="fa fa-paper-plane me-2"></i> Kirim Pesan
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ✅ Map --}}
            <div class="row mt-5">
                <div class="col-12">
                    <div class="rounded-4 overflow-hidden border" style="box-shadow:0 4px 20px rgba(128,0,0,0.08);">
                        <div class="d-flex align-items-center gap-2 px-4 py-3" style="background:#800000;">
                            <i class="fa fa-map-marker text-white"></i>
                            <span class="text-white fw-semibold" style="font-size:0.9rem;letter-spacing:.5px;">LOKASI KAMI
                                — SMA NEGERI PLUS PROVINSI RIAU</span>
                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8062.54813596318!2d101.39923702907177!3d0.4132533742490759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a873ae3de173%3A0x6596574a06800d8d!2sSMA%20Negeri%20Plus%20Provinsi%20Riau!5e1!3m2!1sen!2sid!4v1755435483166!5m2!1sen!2sid"
                            width="100%" height="420" style="border:0;display:block;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ✅ Hover Effect --}}
    <style>
        .contact-page .d-flex.align-items-center:hover {
            border-color: #800000 !important;
            transform: translateX(4px);
        }

        #contact-form button[type="submit"]:hover {
            background: #600000 !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(128, 0, 0, 0.3);
        }

        .form-control:focus {
            border-color: #800000;
            box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.12);
        }
    </style>

@endsection
