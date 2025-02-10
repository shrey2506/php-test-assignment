<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    
    <!-- Display the logged-in user's name -->
    <p>
        Welcome, 
        {{ session('user')['first_name'] ?? 'User' }} 
        {{ session('user')['last_name'] ?? '' }}
    </p>
    <p><a href="{{ route('logout') }}">Logout</a></p>

    <!-- Display any flash messages -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('api_error'))
        <p style="color: red;">{{ session('api_error') }}</p>
    @endif

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
                            <!-- Link to view the author's detail page -->
                            <a href="{{ route('authors.show', $author['id']) }}">View</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">No authors found.</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
