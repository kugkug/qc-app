<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset - QC Health Department</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .brand {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        .reset-button {
            display: inline-block;
            background: #3182ce;
            color: #fff;
            padding: 12px 32px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: bold;
            letter-spacing: 0.05em;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }
        .warning {
            background-color: #fed7d7;
            border: 1px solid #feb2b2;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #c53030;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">
            QC Health Department
        </div>
        <h2 style="text-align:center; color:#2d3748;">Password Reset Request</h2>
        <p>Dear {{ $firstname ?? 'User' }},</p>
        <p>
            You are receiving this email because we received a password reset request for your account.
        </p>
        <div style="text-align:center; margin: 24px 0;">
            <a href="{{ $reset_url }}" class="reset-button">
                Reset Password
            </a>
        </div>
        <p>
            This password reset link will expire in 60 minutes.
        </p>
        <div class="warning">
            <strong>Security Notice:</strong> If you did not request a password reset, no further action is required. This link will expire automatically.
        </div>
        <p>
            If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
        </p>
        <p style="word-break: break-all; color: #718096; font-size: 14px;">
            {{ $reset_url }}
        </p>
        <div class="footer">
            &copy; {{ date('Y') }} QC Health Department. All rights reserved.
        </div>
    </div>
</body>
</html> 