<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update a product</title>
</head>
<body>
    <form method="post" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Name: <input type="text" name="name" value="{{ $product->name }}"><br>
        Price: <input type="text" name="price" value="{{ $product->price }}"><br>
        Image: <input type="file" name="image">
        <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Admin/') . $product->image) }}" width="100px" height="100px">
        <br>
        Quantity: <input type="text" name="quantity" value="{{ $product->quantity }}"><br>
        Brand: <select name="brand_id">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                    @if($product->brand_id == $brand->id)
                        {{ 'selected' }}
                    @endif
                >
                    {{ $brand->name }}
                </option>
            @endforeach
        </select><br>
        <button>Update</button>
    </form>
</body>
</html>
