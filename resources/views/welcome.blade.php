@extends('layouts.main')

@section('content')

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

    <!-- Image gallery test -->
    Images test here

@endsection
