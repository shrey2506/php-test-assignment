<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Dashboard</h1>
    <p>
        Welcome,
        {{ session('user')['first_name'] ?? 'User' }}
        {{ session('user')['last_name'] ?? '' }}
    </p>
    <p><a href="{{ route('logout') }}">Logout</a></p>
</body>
</html>
