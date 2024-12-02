{{-- resources/views/products/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-weight: bold;
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 10px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button.btn {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border-radius: 30px;
            font-weight: bold;
            margin-top: 20px;
            transition: all 0.3s ease;
            width: 100%;
        }

        button.btn:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        a.btn {
            display: block;
            text-align: center;
            background-color: #6c757d;
            color: #fff;
            padding: 12px 20px;
            border-radius: 30px;
            font-weight: bold;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        a.btn:hover {
            background-color: #5a6268;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            button.btn,
            a.btn {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Product Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label for="price">Price:</label>
            <input type="number" name="price" value="{{ $product->price }}" required>

            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="{{ $product->stock }}" required>

            <label for="category">Category:</label>
            <input type="text" name="category" value="{{ $product->category }}" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="4" required>{{ $product->description }}</textarea>

            <button type="submit" class="btn">Update Product</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn">Back to Product List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
