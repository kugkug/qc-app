<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your One-Time Password (OTP)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 480px;
            margin: 40px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 32px 24px;
        }
        .otp-box {
            font-size: 2.2em;
            letter-spacing: 0.4em;
            font-weight: bold;
            color: #2d3748;
            background: #f1f5f9;
            border-radius: 6px;
            padding: 16px 0;
            text-align: center;
            margin: 24px 0;
        }
        .footer {
            font-size: 0.95em;
            color: #888;
            margin-top: 32px;
            text-align: center;
        }
        .brand {
            font-size: 1.2em;
            color: #3182ce;
            font-weight: bold;
            margin-bottom: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">
            QC Health Department
        </div>
        <h2 style="text-align:center; color:#2d3748;">Your One-Time Password (OTP)</h2>
        <p>Dear {{ $firstname ?? 'User' }},</p>
        <p>
            Please use the following One-Time Password (OTP) to complete your verification process. This code is valid for a limited time only.
        </p>
        <div class="otp-box">
            {{ $otp ?? '------' }}
        </div>
        <p style="text-align:center;">
            <strong>Do not share this code with anyone.</strong>
        </p>
        <div style="text-align:center; margin: 24px 0;">
            @if (!empty($verification_url))
                <a href="{{ $verification_url }}" style="display:inline-block; background:#3182ce; color:#fff; padding:12px 32px; border-radius:5px; text-decoration:none; font-size:1.1em; font-weight:bold; letter-spacing:0.05em;">
                    Verify OTP
                </a>
            @endif
        </div>
        <p>
            If you did not request this code, you can safely ignore this email.
        </p>
        <div class="footer">
            &copy; {{ date('Y') }} QC Health Department. All rights reserved.
        </div>
    </div>
</body>
</html>
