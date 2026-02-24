<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            color: #1b1b18;
            background-color: #f5f5f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #f53003 0%, #ff8a5c 100%);
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: white;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 40px 30px;
            background: white;
        }
        .code {
            text-align: center;
            font-size: 48px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #f53003;
            background: #fff2f2;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            font-family: monospace;
        }
        .footer {
            padding: 20px;
            text-align: center;
            background: #f8f8f8;
            color: #706f6c;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #f53003;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }
        .expiry {
            font-size: 14px;
            color: #706f6c;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BlogSpace</h1>
        </div>
        
        <div class="content">
            <h2 style="margin-top: 0;">Hello {{ $name }}!</h2>
            
            <p>Thank you for registering with BlogSpace. Please use the verification code below to complete your registration:</p>
            
            <div class="code">{{ $code }}</div>
            
            <p style="text-align: center;">Enter this 5-digit code on the verification page to activate your account.</p>
            
            <div class="expiry">
                <strong>Note:</strong> This code will expire in 10 minutes.
            </div>
            
            <hr style="margin: 30px 0; border: none; border-top: 1px solid #e3e3e0;">
            
            <p style="font-size: 14px; color: #706f6c;">
                If you didn't create an account on BlogSpace, you can safely ignore this email.
            </p>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} BlogSpace. All rights reserved.
        </div>
    </div>
</body>
</html>