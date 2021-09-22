@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 shadow-box-right pb-4 pt-xl-2 pe-xl-5">
            {{\Breadcrumbs::render('static','Liên hệ','lien-he')}}
            <h1 class="fs-30-cv robotob wow fadeInUp">Liên hệ</h1>
            <div class="short-content fs-16 mt-3 wow fadeInUp">
                {[contact_content]}
            </div>
            <div class="contact-map mt-3 mb-4 c-img">
               {[iframe_map_contact]}
            </div>
            <div class="wow fadeInUp">
                <p class="text-uppercase robotob fs-18-cv mb-1 pt-xl-2">Bệnh viện đa khoa phương đông</p>
                <p class="fs-16">{[address]}</p>
                <p><a href="mailto:{[email]}" class="smooth d-inline-block hv-sp fs-16" title="Email">Email: {[email]}</a></p>
                <p><a href="tel:{[hotline]}" class="smooth d-inline-block hv-sp fs-16" title="Hotline">Tổng đài tư vấn: {[hotline]}</a></p>
            </div>
            <div class="wow fadeInUp">
                <p class="text-uppercase robotob fs-18-cv my-3 my-xl-4">Giờ làm việc</p>
                <p class="fs-16">{[time_work]}</p>
                <p><a href="tel:{[hotline_capcuu]}" class="smooth d-inline-block hv-sp fs-16" title="Cấp cứu 24/7">Cấp cứu 24/7: {[hotline_capcuu]}</a></p>
                <p><a href="tel:{[hotline_time_chung]}" class="smooth d-inline-block hv-sp fs-16" title="Hotline Tiêm chủng">Hotline Tiêm chủng: {[hotline_time_chung]}</a></p>
                <p><a href="tel:{[hotline_hotro_khachhang]}" class="smooth d-inline-block hv-sp fs-16" title="Hotline Khoa Sản">Hotline hỗ trợ khách hàng: {[hotline_hotro_khachhang]}</a></p>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop