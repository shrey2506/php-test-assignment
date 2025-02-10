<!DOCTYPE html>
<html>
<head>
    <title>Author Detail</title>
    <meta charset="utf-8">
    <style>
        /* Basic reset */
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

        /* Container styling similar to dashboard and login */
        .container {
            max-width: 70vw;
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
            margin-bottom: 20px;
            line-height: 1.6;
        }

        /* Button styling consistent with login/dashboard */
        .button {
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

        .button:hover {
            background-color: #286090;
        }

        /* Table styling */
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

        /* Form styling for inline actions */
        form {
            display: inline;
        }

        /* Center the navigation link */
        .nav-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Author Detail</h1>

        <!-- Author Information -->
        <div class="profile">
            <p><strong>ID:</strong> {{ $author['id'] }}</p>
            <p><strong>First Name:</strong> {{ $author['first_name'] }}</p>
            <p><strong>Last Name:</strong> {{ $author['last_name'] }}</p>
            <p><strong>Birthday:</strong> {{ $author['birthday'] }}</p>
            <p><strong>Gender:</strong> {{ $author['gender'] }}</p>
            <p><strong>Place of Birth:</strong> {{ $author['place_of_birth'] }}</p>
            <p><strong>Biography:</strong> {{ $author['biography'] ?? 'N/A' }}</p>
        </div>

        <!-- Books Section -->
        <h2>Books</h2>
        @if(isset($author['books']) && count($author['books']) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Release Date</th>
                        <th>Description</th>
                        <th>ISBN</th>
                        <th>Format</th>
                        <th>Pages</th>
                        <th>Actions</th>
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
                            <td>
                                <!-- Delete Book Form -->
                                <form method="POST" action="{{ route('books.destroy', $book['id']) }}" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button">Delete Book</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No books available for this author.</p>
        @endif

        <!-- Conditionally display Delete Author Button if there are no books -->
        @if(!isset($author['books']) || count($author['books']) == 0)
            <form method="POST" action="{{ route('authors.destroy', $author['id']) }}" onsubmit="return confirm('Are you sure you want to delete this author?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Delete Author</button>
            </form>
        @endif

        <!-- Navigation Link -->
        <div class="nav-link">
            <a href="{{ route('dashboard') }}" class="button">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
