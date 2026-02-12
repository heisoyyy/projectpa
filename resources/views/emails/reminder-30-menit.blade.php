<h2>Halo {{ $jadwal->team->nama_tim }}</h2>

<p>
Tim Anda akan tampil pada:
</p>

<ul>
    <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}</li>
    <li><strong>Jam:</strong> {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</li>
</ul>

<p style="color:red; font-weight:bold;">
⚠️ 30 menit lagi giliran Anda tampil.
</p>

<p>
Silakan segera menuju area tunggu dan bersiap.
</p>

<p>Terima kasih.</p>
