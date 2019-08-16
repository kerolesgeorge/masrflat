<!DOCTYPE html>
<html lang="en" dir="rtl">
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

    <title>Admin Page</title>
</head>
<body id="admin-page">
    <div id="app">
        <!-- Navbar section -->
        <nav>
            <div id="navbar">
                <a href="javascript:void(0)" id="close" onclick="slide()" dir="rtl">&times;</a>
                <h3>شقة x مصر الجديده</h3>
                <h4><i class="fas fa-toolbox ml-2"></i> ادارة الموقع</h4>
                <a href="/admin/cities">ادارة المدن</a>
                <a href="/admin/neighbourhoods">ادارة الاحياء</a>
                <a href="/admin/types">انواع العقارات</a>
                <a href="/admin/contracts">العقود</a>
                <a href="/admin/finishes">التشطيبات</a>
                <a href="#">الواجهات</a>
                <a href="#">العقارات</a>
                <a href="#">خروج</a>
            </div>
            <div class="navbar-toggler text-right" onclick="slide()">
                <i class="fas fa-bars fa-2x"></i>
            </div>
        </nav>

        <!-- overlay for navbar -->
        <div class="overlay"></div>

        <!-- Content area -->
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.locales.min.js') }}"></script> --}}

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
