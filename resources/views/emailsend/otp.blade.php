<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User verification </title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7fa; padding: 20px; margin: 0;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333; text-align: center;">Email Verification</h2>
        <p style="font-size: 1.1em; color: #555;">Dear User,{{ $user->name }}</p>
        <p style="font-size: 1em; color: #555; line-height: 1.5;">
            Your Email is : {{ $user->email }}
            <br>
            Your UserId is : {{ $user->id }}
            <br>
            Your Role is : {{ $user->role }}
            <br>
            Your Register date is : {{ $user->created_at }}
        </p>
        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
        <p style="font-size: 0.9em; color: #999; text-align: center;">
        </p>
        <p style="font-size: 0.9em; color: #999; text-align: center;">
            Thank you,<br>
            The Team
        </p>
    </div>
</body>
</html>
