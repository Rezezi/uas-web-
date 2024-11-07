{{-- resources/views/books/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for Books Page */
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-weight: bold;
        }

        .logout-btn, .login-btn {
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-align: center;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-3px);
            text-decoration: none;
        }

        .login-btn {
            background-color: #28a745;
        }

        .login-btn:hover {
            background-color: #218838;
            transform: translateY(-3px);
            text-decoration: none;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table th, table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #e9ecef;
            transition: background-color 0.3s ease;
        }

        table tr:hover {
            background-color: #f1f3f5;
        }

        .btn-warning, .btn-danger {
            border-radius: 30px;
            padding: 8px 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 5px 10px rgba(255, 193, 7, 0.3);
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: translateY(-3px);
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            .btn, .btn-warning, .btn-danger {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Library Books</h1>

        <!-- Login/Logout Button -->
        <div class="d-flex justify-content-end mb-3">
            @if(Auth::check())
                <button type="button" class="logout-btn" onclick="logout()">Logout</button>
            @else
                <a href="{{ route('login') }}" class="login-btn">Login</a>
            @endif
        </div>

        <!-- Add New Book Button (Only visible to authenticated users) -->
        @if(Auth::check())
            <a href="{{ route('books.create') }}" class="btn mb-3">Add New Book</a>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <!-- Books Table -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Stock</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>
                        @if(Auth::check())
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @else
                            <span class="text-muted">Login to edit or delete</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function logout() {
            fetch("{{ route('logout') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.href = "{{ route('books.index') }}";
                }
            });
        }

        function confirmDelete() {
            return confirm('Are you sure you want to delete this book? This action cannot be undone.');
        }
    </script>
</body>
</html>
