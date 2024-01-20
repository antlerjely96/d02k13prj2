<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <a href="{{ route('register') }}">Register</a>
    <form>
        Email: <input type="text"><br>
        Password: <input type="password"><br>
        <button type="button">Login</button>
    </form>
</body>
</html>
