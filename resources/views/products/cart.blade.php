<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product image</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th></th>
        </tr>
        @foreach(\Illuminate\Support\Facades\Session::get('cart') as $product_id => $product)
            <tr>
                <td>
                    {{ $product_id }}
                </td>
                <td>
                    {{ $product['name'] }}
                </td>
                <td>
{{--                    <img src="{{  }}">--}}
                </td>
                <td>
                    {{ $product['price'] }}
                </td>
                <td>
                    {{ $product['quantity'] }}
                </td>
                <td>
                    <a href="{{ route('products.deleteFromCart', $product_id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
