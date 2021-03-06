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
            <p class="all-title-detail wow fadeInUp mt-4 mb-2 text-uppercase pt-xl-2">Một số hình ảnh hoạt động của {{$currentItem->name}}</p>
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
            <p class="all-sub-title small-text long wow fadeInUp mt-4 pt-xxl-2 mb-3">Bác sĩ cùng chuyên khoa</p>
            <div class="doctor-same-specialty position-relative wow fadeInUp">
                <div class="swiper-container slide-doctor-same-specialty">
                    <div class="swiper-wrapper">
                       @foreach ($listRelateDoctor as $itemDoctor)
                            <div class="swiper-slide">
                                @include('doctors.item_same_specialty')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slide-doctor-same-specialty-prev prev-btn">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <button class="slide-doctor-same-specialty-next next-btn">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="slider-pagination mt-3 mt-xxl-4">
                    <div class="pagination-doctor-same-specialty"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-28 ps-lg-4">
            @include('specialists.sidebar')
        </div>
    </div>
</section>
@stop