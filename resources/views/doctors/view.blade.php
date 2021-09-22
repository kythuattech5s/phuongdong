@extends('index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/comment.css')}}">
@endsection
@section('content')
<section class="container pt-xl-2">
    {{\Breadcrumbs::render('doctors',$currentItem,$specialists)}}
    <div class="border-top mt-2">
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-28">
            <div class="px-lg-3">
                <div class="sidebar-all py-4">
                    <div class="item-doctor-siderbar wow fadeInUp">
                        <div class="border">
                            <div class="img px- shine-effect">
                                @include('image_loader.big',['itemImage'=>$currentItem])
                            </div>
                            <div class="content text-uppercase fs-12 text-center">
                                {{$currentItem->academic_rank}}: <span class="robotob">{{$currentItem->name}}</span>
                            </div>
                        </div>
                        <div class="rating-info text-center d-flex flex-wrap justify-content-center align-items-center my-2">
                            @php
                                $rating = $currentItem->getRating('main');
                            @endphp
                            <div class="rating-now d-flex align-items-center flex-wrap" data-table="doctors" data-id="{{$currentItem->id}}">
                                @include('path.rating',['rating' => $rating['percentAll'].'%'])
                                <span class="ms-2">{{$rating['scoreAll']}} / 5 ( {{$rating['totalRating']}} bình chọn)</span>
                            </div>
                        </div>
                    </div>
                    <form class="form-contact-sidebar form-send-contact mt-3 mt-xl-4 wow fadeInUp" action="{{VRoute::get('bookApointmentDoctor')}}" method="post" accept-charset="utf8" autocomplete="off">
                        <div class="header-form text-center py-2 py-lg-3">
                            <p class="fs-16 px-3 mb-1">Đặt lịch hẹn với: {{$currentItem->academic_rank}} </p>
                            <p class="fs-18 text-uppercase robotob">{{$currentItem->name}}</p>
                        </div>
                        <div class="form-content p-3 pt-xl-4">
                            <input type="hidden" name="doctor" value="{{$currentItem->id}}">
                            <input type="text" name="fullname" placeholder="Họ và tên (*)">
                            <input type="text" name="phone" placeholder="Số điện thoại (*)">
                            <input type="email" name="email" placeholder="Email (*)">
                            <textarea name="note" rows="2" placeholder="Nội dung"></textarea>
                            <div class="text-center">
                                <button type="submit" class="btn-all btn-all-main btn-small text-uppercase robotob py-2">Gửi yêu cầu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-72 shadow-box-left py-3 py-md-4 ps-lg-5">
            <p class="fs-16 wow fadeInUp">{{$currentItem->academic_rank}}</p>
            <h1 class="text-uppercase fs-26-cv robotob clmain wow fadeInUp">{{$currentItem->name}}</h1>
            <p class="doctor-position text-uppercase wow fadeInUp">{{$currentItem->position}}</p>
            <div class="list-info-doctor-content mt-4">
                @foreach ($contentArr as $itemContent)
                    <div class="item wow fadeInUp">
                        <div class="header-item mb-2 d-flex align-items-center">
                            <p class="fs-22-cv clmain">{{$itemContent['name']}}</p>
                        </div>
                        <div class="content-item s-content fs-16">{!!$itemContent['content']!!}</div>
                    </div>
                @endforeach
            </div>
            <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Hình ảnh hoạt động của {{$currentItem->academic_rank}} {{$currentItem->name}}</p>
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
                                            @include('image_loader.all',['itemImage'=>$itemImg])
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
            @if (count($listNews) > 0)
                <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Các bài viết tham vấn</p>
                @include('news.new_bottom_detail',['listNews'=>$listNews])
            @endif
            @if (count($listRelateDoctor) > 0)
                <p class="all-sub-title small-text long wow fadeInUp mt-4 mb-3 text-uppercase">Bác sĩ cùng chuyên khoa</p>
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
            @endif
        </div>
    </div>
</section>
@stop
@section('jsl')
    <script src="{{asset('frontend/js/comment/xhr.js')}}" defer></script>
    <script src="{{asset('frontend/js/comment/comment.js')}}" defer></script>
@stop