<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile p {
            font-size: 16px;
        }

        .logout {
            text-align: center;
            margin-bottom: 20px;
        }

        .logout a {
            text-decoration: none;
            color: #337ab7;
            font-weight: bold;
        }

        a.button, button.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #337ab7;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        a.button:hover, button.button:hover {
            background-color: #286090;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile and Logout -->
        <div class="profile">
            <h1>Dashboard</h1>
            <p>Welcome, {{ session('user')['first_name'] ?? 'User' }} {{ session('user')['last_name'] ?? '' }}</p>
        </div>
        <div class="logout">
            <a href="{{ route('logout') }}" class="button">Logout</a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if(session('api_error'))
            <p class="error">{{ session('api_error') }}</p>
        @endif

        <!-- Add New Book Link -->
        <p style="text-align: center;"><a href="{{ route('books.create') }}" class="button">Add New Book</a></p>

        <!-- Authors Table -->
        <h2>Authors</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Place of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($authors))
                    @foreach($authors as $author)
                        <tr>
                            <td>{{ $author['id'] }}</td>
                            <td>{{ $author['first_name'] }}</td>
                            <td>{{ $author['last_name'] }}</td>
                            <td>{{ $author['birthday'] }}</td>
                            <td>{{ $author['gender'] }}</td>
                            <td>{{ $author['place_of_birth'] }}</td>
                            <td>
                                <a href="{{ route('authors.show', $author['id']) }}" class="button">View</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align: center;">No authors found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
