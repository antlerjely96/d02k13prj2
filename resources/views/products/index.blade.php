<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product's List</title>
</head>
<body>
    <a href="{{ route('products.create') }}">Add a product</a>
    <a href="{{ route('products.viewCart') }}">View cart</a>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Brand</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>
                    {{ $product->id }}
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Admin/') . $product->image) }}" width="100px" height="100px">
                </td>
                <td>
                    {{ $product->price }}
                </td>
                <td>
                    {{ $product->quantity }}
                </td>
                <td>
                    {{ $product->brand->name }}
                </td>
                <td>
                    <a href="{{ route('products.addToCart', $product) }}">Add to cart</a>
                </td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{ route('products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('customer.logout') }}">Logout</a>
</body>
</html>
