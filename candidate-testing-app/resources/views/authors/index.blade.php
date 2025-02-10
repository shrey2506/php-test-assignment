<!DOCTYPE html>
<html>
<head>
    <title>Authors List</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Authors</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if($errors->has('api_error'))
        <p style="color:red;">{{ $errors->first('api_error') }}</p>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
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

    <p><a href="{{ route('dashboard') }}">Back to Dashboard</a></p>
</body>
</html>
