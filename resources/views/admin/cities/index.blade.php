@extends('layouts.admin')

@section('content')

<div class="admin-content">
    <div class="container">
        <h1 class="mb-4">ادارة المدن</h1>
        <city-component></city-component>

        {{-- <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <city-component></city-component>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <contract-component></contract-component>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <finish-component></finish-component>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <neighbourhood-component></neighbourhood-component>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <view-component></view-component>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <city-component></city-component>
            </div>
        </div> --}}

    </div>
</div>
@endsection
