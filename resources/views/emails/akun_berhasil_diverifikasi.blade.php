<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akun Berhasil Diverifikasi</title>
</head>
<body>
    <h2>Selamat {{ $user->nama_sekolah }}</h2>

    <p>Akun Anda telah berhasil diverifikasi.</p>

    <p>
        Silakan login ke sistem dan segera melengkapi seluruh persyaratan
        pendaftaran yang dibutuhkan.
    </p>

    <p>
        Klik tombol di bawah ini untuk login:
    </p>

    <a href="{{ url('/home/login') }}" 
       style="padding:10px 20px;background:#007bff;color:#fff;text-decoration:none;border-radius:5px;">
        Login Sekarang
    </a>

    <br><br>

    <p>Terima kasih.</p>
</body>
</html>
