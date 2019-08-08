<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar'? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>شقة في مصر الجديده للتسويق العقارى</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/cd18d985db.js"></script>

</head>

<body>

    <div id="app">
        <!-- Navbar section -->
        <div class="nav-container-fluid">
            <div class="container nav-container">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">شقة في مصر الجديده</a>
                    <div class="collapse navbar-collapse mr-3" id="navbarNavAltMarkup">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">عقارات</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">من نحن</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">اتصل بنا</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        @yield('content')

        <!-- Footer section -->
        <div class="footer">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 text-right p-4">
                        <h2 class="mb-4">شقة فى مصر الجديده</h2>
                        <p style="line-height: 2.5">خدمات شقه في مصر الجديده تساعدك على بيع وشراء العقارات بسهولة بالإضافة إلى تزويدك بمعلومات أساسية لإتخاذ واحد من أهم القرارات المالية في حياتك.</p>
                    </div>

                    <div class="col-md-4 text-right p-4">
                        <p dir="rtl">رايك يهمنا</p>
                        <!-- feedback form -->
                        <form id="feedback-form">
                            <div class="form-group text-right">
                                <input type="email" id="email" name="email" class="form-control" placeholder="البريد الاكتروني">
                            </div>
                            <div class="form-group text-right">
                                <textarea id="comment" name="comment" cols="40" rows="5" class="form-control" placeholder="اترك تعليقك"></textarea>
                            </div>
                            <button class="fdbck-btn btn btn-light text-right">ارسل</button>
                        </form>
                    </div>

                    <div class="col-md-4 text-right p-4">
                        <p>للأتصال</p>
                        <p> 012123456789</p>
                        <p>info@masrflat.com</p>
                        <p>
                            الاثنين / الخميس
                            09:00 - 06:00
                        </p>
                        <p>تابع صفحتنا على الفيسبوك</p>
                        <a href="#" class="icons"><i class="fab fa-facebook-square fa-2x"></i></a>
                    </div>

                </div>
            </div>

            <!-- Created by -->
            <div class="d-flex justify-content-center p-1" dir="ltr">
                <span class="copy">&copy; 2019 All rights reserved .</span>
                Created by <a href="{{ url('http://kerolesgeorge.github.io') }}" target="_blank">Keroles George</a>
            </div>

        </div>
    </div>

    <!-- Javascript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
