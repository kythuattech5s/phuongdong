@extends('index')
@section('css')
    <link href="frontend/css/service_add.css" type="text/css" rel="stylesheet" />
@stop
@section('content')
    @php
        $layoutPage = (int)$currentItem->layout_page;
    @endphp
    @if (count($listItems) == 0 && count($listCateChild) == 0)
    <section class="container">
        <div class="row">
            @if ($layoutPage == 1)
                <div class="col-lg-8 col-xl-72 shadow-box-right pt-xl-2 pb-md-4 pb-xxl-5 pe-xxl-5">
            @else
                <div class="col-12">
            @endif
                {{\Breadcrumbs::render('service_category',$currentItem)}}
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
                    {{$currentItem->seo_des}}
                </div>
                <div class="my-3 wow fadeInUp" data-wow-delay="0.4s">
                    {!!$dataContent['toc']!!}
                </div>
                <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                    {!!Support::showContentHasGallery($dataContent['content'],$currentItem->imgs_template)!!}
                </div>
                {!!$currentItem['inject_html']!!}
                @php
                    $listImageItem = json_decode($currentItem->imgs, true);
                @endphp
                @if (is_array($listImageItem) && count($listImageItem) > 0)
                    <p class="all-title-detail wow fadeInUp mt-4 mb-2 text-uppercase">Một số hình ảnh hoạt động của dịch vụ</p>
                    <div class="doctor-image position-relative wow fadeInUp">
                        <div class="swiper-container slide-doctor-image">
                            <div class="swiper-wrapper">
                                @foreach ($listImageItem as $img)
                                    @php
                                        $itemImg = new \Stdclass;
                                        $itemImg->img = $img['image'];
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="item-doctor-image">
                                            <div class="img">
                                                <a href="{%IMGV2.itemImg.img.-1%}" data-fancybox="gallery" class="smooth" title="">
                                                    @include('image_loader.all',['itemImage'=>$itemImg])
                                                </a>
                                            </div>
                                            <div class="content smooth text-center p-3">
                                                <p class="fs-18">{{$img['title']}}</p>
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
                @endif
                @if (isset($videoIntro))
                    <div class="my-4 wow fadeInUp">
                        <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Video giới thiệu {{$currentItem->name}}</p>
                        <div class="video-youtybe-container-new mx-auto mt-3 mt-xl-4">
                            <div class="video-youtybe-container ">
                                {!!$videoIntro->getPlayHtml()!!}
                            </div>
                        </div>
                        <h3 class="mt-2 text-center">
                            <a href="{{Support::show($videoIntro,'slug')}}" class="smooth fs-16 hv-main-sp" title="{{$videoIntro->name}}">{{$videoIntro->name}}</a>
                        </h3>
                    </div>
                @endif
                @if (count($listNews) > 0)
                    <div class="mt-4 mt-xl-5"></div>
                    @if ($currentItem->title_relate_new != '')
                        <p class="all-sub-title small-text long wow fadeInUp mb-3 text-uppercase">{{$currentItem->title_relate_new}}</p>
                    @endif
                    @include('news.new_bottom_detail',['listNews'=>$listNews])
                @endif
            </div>
            @if ($layoutPage == 1)
                <div class="col-lg-4 col-xl-28 ps-lg-4">
                    @include('specialists.sidebar')
                </div>
            @endif
        </div>
    </section>
    @else
        <section class="container pt-xl-2 pb-4 pb-xl-5">
            {{\Breadcrumbs::render('service_category',$currentItem)}}
            <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">{{$currentItem->name}}</h1>
            <p class="fs-16 wow fadeInUp">{{$currentItem->short_content}}</p>
            @if (count($listCateChild))
                <div class="row gx-3 mt-4 pt-xl-2">
                    @foreach ($listCateChild as $item)
                        <div class="col-md-6 col-lg-4 mb-3">
                            @include('services.item')
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row gx-3 mt-4 pt-xl-2">
                    @foreach ($listItems as $item)
                        <div class="col-md-6 col-lg-4 mb-3">
                            @include('services.item')
                        </div>
                    @endforeach
                </div>
                <div class="pagenigation mb-2 mt-3 mt-xl-4">
                    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
                </div>
            @endif
        </section>
    @endif
@stop