<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- FontAwesome 6.3.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <title>Edit Menu</title>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column p-4">
            <form action="{{ route('menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Edit Menu</h2>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-save"></i> Save
                        </button>
                    </div>
                </div>

                {{-- List error validasi, jika ada --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <hr>

                <h5>Menu</h5>
                <input type="text" name="menu" id="image_name" class="w-50 mb-3" value="{{ $menu->menu }}">

                <h5>Harga</h5>
                <input type="text" name="harga" id="image_name" class="w-50 mb-3" value="{{ $menu->harga }}">

                <h5>Deskripsi</h5>
                <input type="text" name="deskripsi" id="image_name" class="w-50 mb-3" value="{{ $menu->deskripsi }}">

                <h5>Gambar</h5>
                <img src='{{ asset("menu-images/$menu->image") }}' class="img-thumbnail" style="max-width: 25vw" 
                            alt="image">
                <input type="file" name="image" id="image" class="mb-3">
            </form>
        </div>
    </div>
</body>

</html>