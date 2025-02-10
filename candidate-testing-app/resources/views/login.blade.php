<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Login</h1>

    <!-- Display any login error messages -->
    @if ($errors->has('login_error'))
        <div style="color: red;">
            {{ $errors->first('login_error') }}
        </div>
    @endif

    <!-- The login form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
