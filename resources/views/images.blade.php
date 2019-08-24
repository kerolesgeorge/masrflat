<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/cd18d985db.js"></script>

    <title>Images</title>
</head>
<body>
    <!-- images gallery test -->
    <div class="container">
        <div class="row mt-3">
            @foreach ($images as $image)
                <div class="col-4 mb-4">
                    <a href="storage/{{ $image->url }}">
                        <img src="storage/{{ $image->url }}" class="w-100">
                    </a>

                    <form action="/images/{{ $image->id }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <button class="btn btn-outline-danger mt-2">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
