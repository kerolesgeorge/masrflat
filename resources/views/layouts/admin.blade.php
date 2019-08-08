<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/cd18d985db.js"></script>

    <title>Admin Page</title>
</head>
<body>

    <!-- Navbar section -->
    <nav>
        <div id="navbar">
            <a href="javascript:void(0)" id="close" onclick="slide()" dir="rtl">&times;</a>
            <h3>شقة x مصر الجديده</h3>
            <h4><i class="fas fa-toolbox ml-2"></i> ادارة الموقع</h4>
            <a href="#">ادارة المدن</a>
            <a href="#">ادارة الاحياء</a>
            <a href="#">انواع العقارات</a>
            <a href="#">انواع العقود</a>
            <a href="#">انواع التشطيبات</a>
            <a href="#">الواجهات</a>
            <a href="#">العقارات</a>
            <a href="#">خروج</a>
        </div>
        <div class="navbar-toggler text-right" onclick="slide()">
            <i class="fas fa-bars fa-2x"></i>
        </div>
    </nav>

      <!-- overlay for navbar -->
      <div id="overlay"></div>

      <!-- Content area -->
      @yield('content')

      <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
