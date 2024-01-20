<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a product</title>
</head>
<body>

    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        Name: <input type="text" name="name">
        @if($errors->has('name'))
            {{ $errors->first('name') }}
        @endif<br>
        Image: <input type="file" name="image">
        @if($errors->has('image'))
            {{ $errors->first('image') }}
        @endif<br>
        Price: <input type="text" name="price">
        @if($errors->has('price'))
            {{ $errors->first('price') }}
        @endif<br>
        Quantity: <input type="text" name="quantity">
        @if($errors->has('quantity'))
            {{ $errors->first('quantity') }}
        @endif<br>
        Brand: <select name="brand_id">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">
                    {{ $brand->name }}
                </option>
            @endforeach
        </select><br>
        <button>Add</button>
    </form>
</body>
</html>
