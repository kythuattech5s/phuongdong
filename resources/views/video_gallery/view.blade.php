@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-72 shadow-box-right pt-xl-2  pb-md-4 pb-xxl-5 pe-xxl-5">
            {{\Breadcrumbs::render('video_gallery',$currentItem,$parent)}}
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
            <div class="c-img my-3 my-xl-4 wow fadeInUp" style="padding-top: 56%">
                {!!$currentItem->getPlayHtml()!!}
            </div>
            <div class="short-content-new fs-16 wow fadeInUp" data-wow-delay="0.3s">
                {{$currentItem->short_content}}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$currentItem->content!!}
            </div>
            @if (count($videoRelateds) > 0)
                <p class="all-sub-title black robotob wow fadeInUp mt-4 mb-3 mb-xl-4 text-uppercase pt-xl-2">Xem thêm video khác</p>
                <div class="galley-slider position-relative wow fadeInUp">
                    <div class="swiper-container slide-galley">
                        <div class="swiper-wrapper">
                            @foreach ($videoRelateds as $item)
                                <div class="swiper-slide">
                                    @include('video_gallery.item')
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