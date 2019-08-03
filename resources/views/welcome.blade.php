<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() == 'ar'? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">شقة في مصر الجديده</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mr-3" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">من نحن</a>
                    <a class="nav-item nav-link" href="#">اتصل بنا</a>
                    <a class="nav-item nav-link" href="#">عقارات</a>
                </div>
            </div>
        </nav>
        <main>
            <div class="hero-image">
                <div class="hero-text">
                    <h1>شقة في مصر الجديده</h1>
                    <p>ابحث عن عقار للبيع في مصر الجديده</p>
                </div>
            </div>
        </main>
    </body>
</html>
