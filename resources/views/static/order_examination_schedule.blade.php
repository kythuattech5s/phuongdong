@extends('index')
@section('content')
<section class="container mt-xl-2">
    {{\Breadcrumbs::render('static','Đặt câu hỏi','dat-cau-hoi')}}
    <div class="row pb-4 pb-xl-5 pt-lg-3">
        <div class="col-lg-7 pe-lg-5 mt-4 wow fadeInUp">
            @include('static.form_order_examination_schedule')
        </div>
        <div class="col-lg-5 mt-4">
            @include('static.hotline_bg')
        </div>
    </div>
</section>
@stop