<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brands</title>
</head>
<body>
    <a href="{{ route('brands.create') }}">Add a brand</a>
    <table border="1px" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Country</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($brands as $brand)
            <tr>
                <td>
                    {{ $brand->id }}
                </td>
                <td>
                    {{ $brand->name }}
                </td>
                <td>
                    {{ $brand->country }}
                </td>
                <td>
                    <a href="{{ route('brands.edit', $brand) }}">Edit</a>
                </td>
                <td>
                    <form action="{{ route('brands.destroy', $brand) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
