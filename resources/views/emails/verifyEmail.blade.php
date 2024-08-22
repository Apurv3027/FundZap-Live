<!DOCTYPE html>
<html>

<head>
    <title>Verify Your Email</title>
</head>

<body>
    <h1>Hello, {{ $user->first_name . ' ' . $user->last_name }}!</h1>
    <p>Please click the link below to verify your email address:</p>
    <a href="{{ $verificationUrl }}">Verify Email</a>
    <p>If you did not create an account, no further action is required.</p>
</body>

</html>
