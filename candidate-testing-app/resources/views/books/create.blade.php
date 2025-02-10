<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
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
        
        /* Consistent container styling */
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        form {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #337ab7;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background-color: #286090;
        }
        
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .nav-link {
            text-align: center;
        }
        
        .nav-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #337ab7;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        
        .nav-link a:hover {
            background-color: #286090;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Book</h1>

        <!-- Display Validation Errors -->
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display API Error Message if Present -->
        @if(session('api_error'))
            <p class="error">{{ session('api_error') }}</p>
        @endif

        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div>
                <label for="author_id">Author:</label>
                <select name="author_id" id="author_id" required>
                    <option value="">-- Select Author --</option>
                    @foreach($authors as $author)
                        <option value="{{ $author['id'] }}" {{ old('author_id') == $author['id'] ? 'selected' : '' }}>
                            {{ $author['first_name'] }} {{ $author['last_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            </div>
            <div>
                <label for="release_date">Release Date:</label>
                <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <div>
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}">
            </div>
            <div>
                <label for="format">Format:</label>
                <input type="text" name="format" id="format" value="{{ old('format') }}">
            </div>
            <div>
                <label for="number_of_pages">Number of Pages:</label>
                <input type="number" name="number_of_pages" id="number_of_pages" value="{{ old('number_of_pages') }}">
            </div>
            <button type="submit">Add Book</button>
        </form>

        <div class="nav-link">
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
