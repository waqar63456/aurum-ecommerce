<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP Verification</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            color: #333;
        }

        /* Header styling */
        .header {
            background-color: #61426c;
            padding: 20px;
            color: #fff;
            text-align: center;
            font-size: 24px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* OTP container */
        .otp-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        .otp-container h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #61426c;
        }

        .otp-container p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 36px;
            color: #ff2727;
            margin-bottom: 30px;
            animation: pulse 1s infinite;
        }

        .otp-container .expire-info {
            font-size: 16px;
            color: #826a6a;
        }

        /* Button styling */
        .btn {
            background-color: #61426c;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn:hover {
            background-color: #61426c;
        }

        /* Footer styling */
        .footer {
            background-color: #61426c;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            margin-top: auto;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {!
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <strong>OTP Verification</strong>
    </div>

    <!-- OTP Container -->
    <div class="otp-container">
        <h1>Hello, {{ $customer->name }}</h1>
        <p>Thank you for Visiting our platform. Your OTP Code for Email Verification is:</p>
        <h2 class="otp-code">{{ $otp }}</h2>
        <p class="expire-info">This OTP will expire in<strong> 2 minutes</strong>. Please use this code to verify your account.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        © {{ date('Y') }} Aurum. All Rights Reserved.
    </div>

</body>
</html>
