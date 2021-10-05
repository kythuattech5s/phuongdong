@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-72 shadow-box-right pt-xl-2 pb-md-4 pb-xxl-5 pe-xxl-5">
            {{\Breadcrumbs::render('image_gallery',$currentItem,$parent)}}
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
            <div class="short-content-new fs-16 wow fadeInUp" data-wow-delay="0.3s">
                {{$currentItem->short_content}}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$currentItem->content!!}
            </div>
            <p class="fs-18 robotob wow fadeInUp mt-4 mb-2 text-uppercase pt-xl-2">Hình ảnh {{$currentItem->name}}</p>
            <div class="row gx-2 wow fadeInUp">
                @php
                    $imgs = json_decode($currentItem->imgs, true);
                    $imgs = $imgs !== null ? $imgs : [json_decode($currentItem->img,true)];
                @endphp
                @foreach ($imgs as $img)
                    @php
                        $itemImg = new \Stdclass;
                        $itemImg->img = json_encode($img);
                    @endphp
                    <div class="col-6 col-lg-4">
                        <div class="item-image-gallery mb-2">
                            <a href="{%IMGV2.itemImg.img.-1%}" data-fancybox="gallery" data-animation-effect="fade" class="smooth c-img" title="">
                                @include('image_loader.big',['itemImage'=>$itemImg])
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($imageRelateds) > 0)
                <p class="all-sub-title black robotob wow fadeInUp mt-4 mb-3 mb-xl-4 text-uppercase pt-xl-2">Xem thêm ảnh</p>
                <div class="galley-slider position-relative wow fadeInUp">
                    <div class="swiper-container slide-galley">
                        <div class="swiper-wrapper">
                            @foreach ($imageRelateds as $item)
                                <div class="swiper-slide">
                                    @include('image_gallery.item')
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="slider-pagination mt-3">
                        <div class="pagination-galley"></div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-4 col-xl-28 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop