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

    <!-- Hero image section -->
    <div class="hero-image">
        <div class="hero-text">
            <div class="hero-slogan">
                <h1>عقارات للبيع في مصر الجديده</h1>
                <h2 class="mt-3">إبحث عن عقار</h2>
            </div>
        </div>
    </div>

    <!-- Seach box section -->
    <div class="container search-container">
        <div class="search-box" dir="rtl">
            <form dir="rtl">
                <div class="form-row text-right" dir="rtl">
                    <div class="form-group col-md-4">
                        <label for="inputCity">نوع العقار</label>
                        <select id="inputState" class="form-control p-1">
                            <option>شقق</option>
                            <option>شقق مفروشه</option>
                            <option>فيلات</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">الحاله</label>
                        <select id="inputState" class="form-control p-1">
                            <option>للبيع</option>
                            <option>للأيجار</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">الحي</label>
                        <select id="inputState" class="form-control p-1">
                            <option selected>مصر الجديده</option>
                            <option>مدينة مصر</option>
                            <option>النزهه</option>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary pl-5 pr-5">بحث</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cards section -->
    <div class="container cards-container">
        <div style="text-align: center">
           <h3>&#9472; اخر الاضافات &#9472;</h3>
        </div>
        <div class="card-deck mt-5">
            <div class="card">
                <img src="/images/uploads/upload_01.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional
                        content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img src="/images/uploads/upload_01.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img src="/images/uploads/upload_01.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                        content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Javascript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
