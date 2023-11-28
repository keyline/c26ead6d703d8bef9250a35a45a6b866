<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #9b8afb;
        }

        p {
            line-height: 1.6;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #9b8afb;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="{{ env('UPLOADS_URL') . $emailData['site_logo'] }}" alt="{{ $emailData['site_name'] }}">
        </div>

        <h2>Email Verification</h2>

        <p>Dear {{ $emailData['fname'] }} {{ $emailData['lname'] }},</p>

        <p>
            Thank you for signing up with {{ $emailData['site_name'] }}. To complete your registration, please click the
            link below to verify your email address:
        </p>

        <p>
            <a href="{{ $emailData['link'] }}" class="btn" target="_blank">Verify Email</a>
        </p>

        <p>
            If you didn't create an account with {{ $emailData['site_name'] }}, you can ignore this email.
        </p>

        <p>Best regards,<br>
            {{ $emailData['site_name'] }} Team</p>
    </div>

</body>

</html>
