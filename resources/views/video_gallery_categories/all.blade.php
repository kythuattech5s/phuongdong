@extends('index')
@section('content')
<section class="container pt-xl-2 pb-4">
    {{\Breadcrumbs::render('static','Thư viện video','thu-vien-video')}}
    <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">Thư viện video</h1>
    <div class="fs-16 wow fadeInUp">{[video_gallery_page_content]}</div>
</section>
<section class="hot-galley-module pt-4 pb-3">
    <div class="container mt-xl-2">
        <div class="position-relative mb-4 pb-xl-2 wow fadeInUp">
            <div class="swiper-container slide-hot-galley">
                <div class="swiper-wrapper">
                    @foreach (array_slice($listHotItems,0,1) as $item)
                        <div class="swiper-slide">
                            @include('video_gallery.item_hot')
                        </div>
                    @endforeach
                    @foreach (array_slice($listHotItems,0,1) as $key => $item)
                        @if ($key > 4)
                            <div class="swiper-slide">
                                @include('video_gallery.item_hot')
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="slider-controls">
                <button class="slide-hot-galley-prev prev-btn">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </button>
                <button class="slide-hot-galley-next next-btn">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="row gx-3 gx-lg-4">
            @foreach (array_slice($listHotItems,1,4) as $item)
                <div class="col-6 col-lg-3 mb-3 wow fadeInUp">
                    @include('video_gallery.item')
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="container pt-3 pt-xl-4 pb-lg-4">
    @foreach ($listItems as $itemCate)
        @php
            $listItemGallery = $itemCate->videoGallery()->act()->take(3)->get();
        @endphp
        @if ($listItemGallery->count() > 0)
            <div class="item-gallery-category mb-4 wow fadeInUp">
                <h2><a href="{{Support::show($itemCate, 'slug')}}" class="smooth fs-21-cv robotob text-uppercase" title="{{$itemCate->name}}">{{$itemCate->name}}</a></h2>
                <div class="row mt-2">
                    @foreach ($listItemGallery as $item)
                        <div class="col-sm-6 col-lg-4 mb-3 mx-auto">
                            @include('video_gallery.item')
                        </div>
                    @endforeach
                </div>
                <div class="view-more position-relative text-center mt-2">
                    <a href="{{Support::show($itemCate, 'slug')}}" class="smooth" title="Xem tất cả">Xem tất cả</a>
                </div>
            </div>
        @endif
    @endforeach
</section>
@stop