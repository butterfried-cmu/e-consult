<!DOCTYPE html>
<html>
<head>
    <title>Reset password</title>
</head>
<body>
    <h1>Mail from E-consult</h1>
    <p>To, {{ $user->name_title }}{{ $user->first_name }} {{ $user->last_name }}</p>
    <p>Here is your reset password link</p>
    <p>{{ $resetPasswordURL  }}</p>
</body>
</html>