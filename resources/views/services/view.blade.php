@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-72 shadow-box-right pt-xl-2 pb-md-4 pb-xxl-5 pe-xxl-5">
            {{\Breadcrumbs::render('services',$currentItem,$parent)}}
            <h1 class="fs-30-cv robotob mb-1 lh-13 wow fadeInUp">{{$currentItem->name}}</h1>
            <div class="title-info-new d-flex flex-wrap my-3 pb-0 pb-xl-2 fs-15 wow fadeInUp" data-wow-delay="0.2s">
               <p class="me-4">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>{{\Support::showDate($currentItem->created_at)}}</span>
               </p>
                @php
                    $author = $currentItem->getAuthor('create_by');
                @endphp
                @if (isset($author))
                    <p>
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        <span>Tác giả:</span>
                        <span class="robotob">{{$author->name}}</span>
                    </p>
                @endif
            </div>
            <div class="short-content-new robotob fs-16 wow fadeInUp" data-wow-delay="0.3s">
                {{$currentItem->short_content}}
            </div>
            <div class="my-3 wow fadeInUp" data-wow-delay="0.4s">
                {!!$dataContent['toc']!!}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$dataContent['content']!!}
            </div>
            <p class="all-title-detail wow fadeInUp mt-4 mb-2 text-uppercase">Một số hình ảnh hoạt động của dịch vụ</p>
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
                                            @include('image_loader.big',['itemImage'=>$itemImg])
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
            @if ($currentItem->quote != '')
                <p class="all-title-detail wow fadeInUp mt-4 mb-2 text-uppercase">Bảng giá và danh mục {{$currentItem->name}}</p>
                <div class="s-content my-3 new-content-main wow fadeInUp">
                    {!!$currentItem->quote!!}
                </div>
            @endif
            @if (isset($videoIntro))
                <div class="my-4 wow fadeInUp">
                    <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Video giới thiệu {{$currentItem->name}}</p>
                    <div class="video-youtybe-container-new mx-auto mt-3 mt-xl-4">
                        <div class="video-youtybe-container ">
                            {!!$videoIntro->iframe_video!!}
                        </div>
                    </div>
                    <h3 class="mt-2 text-center">
                        <a href="{{Support::show($videoIntro,'slug')}}" class="smooth fs-16 hv-main-sp" title="{{$videoIntro->name}}">{{$videoIntro->name}}</a>
                    </h3>
                </div>
            @endif
            <div class="my-4 fs-16 robotob">{!!$currentItem->end_content!!}</div>
            @if (count($listNews) > 0)
                <p class="all-sub-title small-text long wow fadeInUp mb-3 text-uppercase">Bài viết về ung thư</p>
                @include('news.new_bottom_detail',['listNews'=>$listNews])
            @endif
        </div>
        <div class="col-lg-4 col-xl-28 ps-lg-4">
            @include('specialists.sidebar')
        </div>
    </div>
</section>
@stop