<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            text-align: center;
        }

        h1 {
            color: #2c3e50;
        }

        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You!</h1>
        <p>Hello {{ $order->user->name ?? 'Customer' }},</p>

        <p>We have received your order. We appreciate your trust and look forward to serving you.</p>

        <p>Our team will process your order shortly and keep you updated.</p>

        <div class="footer">
            <p>Need help? Contact us at support@example.com</p>
            <p>&copy; {{ date('Y') }} Kadiwala PVT.LTD</p>
        </div>
    </div>
</body>
</html>
