<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan dari Website</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 0;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #800000, #a00000);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #800000;
            border-radius: 5px;
        }
        .label {
            font-weight: bold;
            color: #800000;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .value {
            font-size: 16px;
            color: #333;
        }
        .message-content {
            background: white;
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            white-space: pre-wrap;
            font-size: 15px;
            line-height: 1.6;
        }
        .reply-info {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .reply-info strong {
            color: #1565c0;
        }
        .footer {
            text-align: center;
            color: #6c757d;
            font-size: 12px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesan Baru dari Website</h1>
            <p>OSIS SMAN Plus Provinsi Riau</p>
        </div>

        <div class="content">
            <p style="margin-bottom: 25px; font-size: 16px;">Anda menerima pesan baru dari form contact website:</p>

            <div class="field">
                <div class="label">Nama Pengirim</div>
                <div class="value">{{ $data['name'] }}</div>
            </div>

            <div class="field">
                <div class="label">Email Pengirim</div>
                <div class="value">{{ $data['email'] }}</div>
            </div>

            <div class="field">
                <div class="label">Subject</div>
                <div class="value">{{ $data['subject'] }}</div>
            </div>

            <div class="field">
                <div class="label">Pesan</div>
                <div class="message-content">{{ $data['message'] }}</div>
            </div>

            <div class="field">
                <div class="label">Waktu Dikirim</div>
                <div class="value">{{ $data['sent_at'] }}</div>
            </div>

            <div class="reply-info">
                <p><strong>Cara Membalas:</strong></p>
                <p>Anda dapat membalas langsung dengan klik reply pada email ini, atau kirim email baru ke: <strong>{{ $data['email'] }}</strong></p>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis dari sistem website SMAN Plus Provinsi Riau</p>
            <p>ProjectPA © 2025 - Laravel Email System</p>
        </div>
    </div>
</body>
</html>