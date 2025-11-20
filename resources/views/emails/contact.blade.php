<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Notifikasi</title>
</head>

<body style="margin:0; padding:0; background:#f4f5f7; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f5f7; padding:20px;">
    <tr>
        <td align="center">

            <table width="620" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; border:1px solid #e1e1e1; overflow:hidden;">
                
                <!-- Header -->
                <tr>
                    <td style="background: linear-gradient(135deg, #720000, #9a0000); padding:28px; text-align:center; color:#ffffff;">
                        <h1 style="margin:0; font-size:22px; font-weight:600;">Pesan Baru dari Website</h1>
                        <p style="margin-top:6px; font-size:14px; opacity:0.95;">OSIS SMAN Plus Provinsi Riau</p>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding:28px; color:#ff0000; font-size:15px; line-height:1.6;">

                        <p style="margin-bottom:22px;">
                            Anda menerima pesan baru dari formulir kontak website:
                        </p>

                        <!-- Field -->
                        <div style="margin-bottom:18px; padding:14px; background:#f7f8fa; border-left:4px solid #7a0c0c; border-radius:4px;">
                            <div style="font-size:13px; font-weight:bold; color:#7a0c0c; margin-bottom:6px;">Nama Pengirim</div>
                            <div style="font-size:15px;">{{ $data['name'] }}</div>
                        </div>

                        <div style="margin-bottom:18px; padding:14px; background:#f7f8fa; border-left:4px solid #7a0c0c; border-radius:4px;">
                            <div style="font-size:13px; font-weight:bold; color:#7a0c0c; margin-bottom:6px;">Email Pengirim</div>
                            <div style="font-size:15px;">{{ $data['email'] }}</div>
                        </div>

                        <div style="margin-bottom:18px; padding:14px; background:#f7f8fa; border-left:4px solid #7a0c0c; border-radius:4px;">
                            <div style="font-size:13px; font-weight:bold; color:#7a0c0c; margin-bottom:6px;">Subjek</div>
                            <div style="font-size:15px;">{{ $data['subject'] }}</div>
                        </div>

                        <div style="margin-bottom:18px; padding:14px; background:#f7f8fa; border-left:4px solid #7a0c0c; border-radius:4px;">
                            <div style="font-size:13px; font-weight:bold; color:#7a0c0c; margin-bottom:6px;">Isi Pesan</div>
                            <div style="background:#ffffff; border:1px solid #dddddd; border-radius:6px; padding:16px; font-size:15px; white-space:pre-wrap; line-height:1.6;">
                                {{ $data['message'] }}
                            </div>
                        </div>

                        <div style="margin-bottom:18px; padding:14px; background:#f7f8fa; border-left:4px solid #7a0c0c; border-radius:4px;">
                            <div style="font-size:13px; font-weight:bold; color:#7a0c0c; margin-bottom:6px;">Waktu Dikirim</div>
                            <div style="font-size:15px;">{{ $data['sent_at'] }}</div>
                        </div>

                        <!-- Reply Info -->
                        <div style="background:#eaf2fb; border-left:4px solid #1b5ebc; border-radius:6px; padding:18px; margin-top:25px;">
                            <p style="margin:0 0 8px 0; color:#1b5ebc; font-weight:bold;">Cara Membalas:</p>
                            <p style="margin:0;">
                                Anda dapat langsung membalas dengan mengeklik tombol “Reply” pada email ini,
                                atau mengirim email baru ke:
                                <strong>{{ $data['email'] }}</strong>
                            </p>
                        </div>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="text-align:center; padding:20px; font-size:12px; color:#777777; border-top:1px solid #e1e1e1; background:#fafafa;">
                        <p style="margin:0;">Email ini dikirim otomatis oleh sistem website Komando SMAN Plus Provinsi Riau.</p>
                        <p style="margin:4px 0 0 0;">&copy; {{ date('Y') }} SMAN PLUS PROVINSI RIAU. All rights reserved.</p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
