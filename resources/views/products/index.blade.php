<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            font-family: 'Poppins', sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin-top: 50px;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
            font-weight: bold;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6610f2, #007bff);
            transform: translateY(-3px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
        }

        table thead {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
        }

        table th,
        table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        table tbody tr {
            background: #f8f9fa;
        }

        table tbody tr:hover {
            background: #e9ecef;
            transform: scale(1.02);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
            color: #fff;
            border-radius: 30px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #fd7e14, #ffc107);
            transform: translateY(-3px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #e55353);
            color: #fff;
            border-radius: 30px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #e55353, #dc3545);
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            .btn-primary,
            .btn-warning,
            .btn-danger {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Product Management</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this product? This action cannot be undone.');
        }
    </script>
</body>

</html>
