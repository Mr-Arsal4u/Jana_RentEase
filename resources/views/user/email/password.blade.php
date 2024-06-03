<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Your Booking and account have been successfully created.Please click the link below to set a new password:</p>
    <p>Your Current passowrd is "{{$password}}"</p>
    <p><a href="{{route('update.password')}}">Click here to add a password to your account</a></p>
    
    <p>If you did not request a password reset, please ignore this email.</p>
</body>
</html>
