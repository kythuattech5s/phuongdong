@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-72 shadow-box-right pt-1 pb-md-4 pb-xxl-5 pe-xxl-5">
            <ul class="breadcrumb">
                {{\Breadcrumbs::render('specialists',$currentItem)}}
            </ul>
            <h1 class="fs-30-cv robotob mb-1 lh-13 wow fadeInUp">{{$currentItem->name}}</h1>
            <div class="title-info-new d-flex flex-wrap my-3 pb-0 pb-xl-2 fs-15 wow fadeInUp" data-wow-delay="0.2s">
               <p class="me-4">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>{{\Support::showDate($currentItem->created_at)}}</span>
               </p>
               <p>
                   <i class="fa fa-user-o" aria-hidden="true"></i>
                   <span>Tác giả:</span>
                   <span class="clmain">{{$currentItem->publish_by}}</span>
               </p>
            </div>
            <div class="short-content-new robotob fs-16 wow fadeInUp" data-wow-delay="0.4s">
                {{$currentItem->short_content}}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$currentItem->content!!}
            </div>
            <p class="all-title-detail wow fadeInUp mt-4 mb-2 text-uppercase pt-xl-2">Một số hình ảnh hoạt động của dịch vụ</p>
            <div class="doctor-image position-relative wow fadeInUp">
                <div class="swiper-container slide-doctor-image">
                    <div class="swiper-wrapper">
                        @php
                            $imgs = json_decode($currentItem->imgs, true);
                            $imgs = $imgs !== null ? $imgs : [json_decode($currentItem->img,true)];
                        @endphp
                        @foreach ($imgs as $img)
                            @php
                                $itemImg = new \Stdclass;
                                $itemImg->img = json_encode($img);
                            @endphp
                            <div class="swiper-slide">
                                <div class="item-doctor-image">
                                    <div class="img">
                                        <a href="{%IMGV2.itemImg.img.-1%}" data-fancybox="gallery" class="smooth" title="">
                                            <img src="{%IMGV2.itemImg.img.-1%}" title="{%AIMGV2.itemImg.img.title%}" alt="{%AIMGV2.itemImg.img.alt%}">
                                        </a>
                                    </div>
                                    <div class="content smooth text-center p-3">
                                        <p class="fs-18">{%AIMGV2.itemImg.img.alt%}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slide-doctor-image-prev prev-btn">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <button class="slide-doctor-image-next next-btn">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <p class="all-title-detail wow fadeInUp mt-4 mb-2 text-uppercase pt-xl-2">Bảng giá và danh mục {{$currentItem->name}}</p>
            <div class="my-4 wow fadeInUp">
                <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Video giới thiệu {{$currentItem->name}}</p>
                <div class="video-youtybe-container-new mx-auto mt-3 mt-xl-4">
                    <div class="video-youtybe-container ">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/8ZH2zG-ruMI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <h3 class="mt-2 text-center">
                    <a href="" class="smooth fs-16 hv-main-sp" title="">Video giới thiệu {{$currentItem->name}}</a>
                </h3>
            </div>
            <div class="my-4 fs-16 robotob">
                Đoạn text khoảng 120 từ tóm tắt có CTA điều hướng, viết chốt sale tại đây,...Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Quý khách có nhu cầu thăm khám và điều trị bệnh vui lòng đặt lịch qua hotline 19001806 để được tư vấn, hỗ trợ nhanh nhất hoặc để lại thông tin TẠI ĐÂY.
            </div>
            <p class="all-sub-title small-text long wow fadeInUp mb-3 text-uppercase">Bài viết về ung thư</p>
            <div class="bottom-new-detail wow fadeInUp">
                <div class="main-wraper d-flex flex-wrap">
                    <div class="img">
                        <a href="" class="smooth c-img shine-effect" title="">
                            <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                        </a>
                    </div>
                    <div class="content">
                        <h3>
                            <a href="" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                        </h3>
                        <p class="fs-16-cv my-1 my-xl-2">Đại trực tràng là một bộ phận thuộc hệ tiêu hóa và giữ vai trò nhất định trong cơ thể con người. Tuy nhiên, nhiều người vẫn chưa hiểu rõ cấu tạo, vị trí và chức năng của...</p>
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="item-time mt-1 me-3">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>06/09/2021</span>
                            </div>
                            <div class="new-cate-info mt-1">
                                <a href="" class="smooth" title="">SẢN PHỤ KHOA</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-subitem w-100">
                    <li><a href="" class="fs-20-cv">Khám thai lần đầu khi nào và những lưu ý quan trọng</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-xl-28 ps-lg-4">
            @include('specialists.sidebar')
        </div>
    </div>
</section>
@stop