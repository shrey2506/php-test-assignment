<!DOCTYPE html>
<html>
<head>
    <title>Author Detail</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Author Detail</h1>

    @if($errors->has('api_error'))
        <p style="color:red;">{{ $errors->first('api_error') }}</p>
    @endif

    <p>
        <strong>ID:</strong> {{ $author['id'] }}<br>
        <strong>First Name:</strong> {{ $author['first_name'] }}<br>
        <strong>Last Name:</strong> {{ $author['last_name'] }}<br>
        <strong>Birthday:</strong> {{ $author['birthday'] }}<br>
        <strong>Gender:</strong> {{ $author['gender'] }}<br>
        <strong>Place of Birth:</strong> {{ $author['place_of_birth'] }}<br>
        <strong>Biography:</strong> {{ $author['biography'] ?? 'N/A' }}
    </p>

    <h2>Books</h2>
    @if(isset($author['books']) && count($author['books']) > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Description</th>
                    <th>ISBN</th>
                    <th>Format</th>
                    <th>Pages</th>
                </tr>
            </thead>
            <tbody>
                @foreach($author['books'] as $book)
                    <tr>
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['title'] }}</td>
                        <td>{{ $book['release_date'] }}</td>
                        <td>{{ $book['description'] }}</td>
                        <td>{{ $book['isbn'] }}</td>
                        <td>{{ $book['format'] }}</td>
                        <td>{{ $book['number_of_pages'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No books available for this author.</p>
    @endif

    <!-- Show delete button only if there are no books -->
    @if(!isset($author['books']) || count($author['books']) == 0)
        <form method="POST" action="{{ route('authors.destroy', $author['id']) }}" onsubmit="return confirm('Are you sure you want to delete this author?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Author</button>
        </form>
    @else
        <p style="color:red;">Cannot delete author with related books.</p>
    @endif

    <p><a href="{{ route('dashboard') }}">Back to Dashboard</a></p>
</body>
</html>
