@extends('index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/comment.css')}}">
@endsection
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 shadow-box-right pt-2 pt-lg-4 pb-md-4 pb-xxl-5">
            {{\Breadcrumbs::render('news',$currentItem,$parent)}}
            <h1 class="fs-30-cv robotob mb-1 lh-13 wow fadeInUp">{{$currentItem->name}}</h1>
            <div class="title-info-new d-flex flex-wrap align-items-center justify-content-between my-3 pb-0 pb-xl-2 wow fadeInUp" data-wow-delay="0.2s">
                @php
                    $doctor = $currentItem->getDoctor();
                @endphp
                @if (isset($doctor))
                    <div class="author_info d-flex align-items-center mb-2 me-3">
                        <a href="{{$doctor->slug}}" class="smooth img" title="{{$doctor->name}}">
                            <img src="{%IMGV2.doctor.img.-1%}" title="{%AIMGV2.doctor.img.title%}" alt="{%AIMGV2.doctor.img.alt%}">
                        </a>
                        <div class="content lh-13">
                            <p>Tham vấn chuyên môn bài viết</p>
                            <a href="{{$doctor->slug}}" class="smooth d-inline-block robotob hv-main fs-16" title="{{$doctor->name}}">
                                {{$doctor->academic_rank}} {{$doctor->name}}
                            </a>
                            <p class="fs-16">Cập nhật: {{Support::showDate($currentItem->time_published)}}</p>
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
                <div class="title-info-rating d-flex align-items-center mb-2">
                    <button class="me-2">
                        <img src="frontend/images/font-size.png" title="" alt="" class="img-fluid smooth">
                    </button>
                    <div class="rating-info text-center">
                        @php
                            $rating = $currentItem->getRating('main');
                        @endphp
                        @include('path.rating',['rating' => $rating['percentAll'].'%'])
                        <p class="fs-12">{{$rating['scoreAll']}} / 5 ( {{$rating['totalRating']}} bình chọn)</p>
                    </div>
                </div>
            </div>
            <div class="short-content-new robotob fs-16 wow fadeInUp" data-wow-delay="0.4s"> {{$currentItem->short_content}}
            </div>
            <div class="my-3 wow fadeInUp">
                {!!$dataContent['toc']!!}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$dataContent['content']!!}
            </div>
            <div class="rating-new-info d-flex align-items-center flex-wrap wow fadeInUp">
                <div class="view d-flex align-items-center me-4">
                    <i class="fa fa-eye me-1" aria-hidden="true"></i>
                    <span class="number-count">5.9K</span>
                </div>
                <div class="action me-3">
                    <button class="like me-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                    <button class="un-like"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
                </div>
                <p>Bài viết hữu ích?</p>
            </div>
            <div class="the-new-source d-flex justify-content-between flex-wrap my-3 pb-2 wow fadeInUp">
                <div class="new-source me-2">
                    <p class="fs-16 robotob">
                        <i class="fa fa-plus me-1" aria-hidden="true"></i>
                        <span>Nguyền tham khảo</span>
                    </p>
                </div>
                <p class="publisher fs-16">
                    <span>Tác giả:</span>
                    <span class="robotob">{{$currentItem->publish_by}}</span>
                </p>
            </div>
            <div class="share-new d-flex flex-wrap justify-content-between wow fadeInUp">
                <div class="rating-info d-flex align-items-center flex-wrap mb-2">
                    <span class="me-2 fs-16">Đánh giá bài viết:</span>
                    <div class="rating-now d-flex align-items-center flex-wrap" data-table="news" data-id="{{$currentItem->id}}">
                        @include('path.selectStar')
                        <span class="ms-2">{{$rating['scoreAll']}} / 5 ( {{$rating['totalRating']}} bình chọn)</span>
                    </div>
                </div>
                <div class="share">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style mb-2">
                        <a class="a2a_dd"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_email"></a>
                        <a class="a2a_button_pinterest"></a>
                        <a class="a2a_button_instagram"></a>
                    </div>
                </div>
            </div>
            @if (count($tags) > 0)
                <div class="tag-new d-flex align-items-center flex-wrap my-3 my-xl-4 wow fadeInUp">
                    <span class="fs-15 me-3 mb-2"><i class="fa fa-tag me-1" aria-hidden="true"></i>Chủ đề</span>
                    @foreach ($tags as $item)
                        <a href="{{$item->slug}}" class="item-tag mb-2 me-2" title="{{$item->name}}">{{$item->name}}</a>
                    @endforeach
                </div>
            @endif
            <div class="my-4 wow fadeInUp">
                <p class="side-bar-title robotob">VIDEO CÙNG CHỦ ĐỀ</p>
                <div class="video-youtybe-container-new mx-auto mt-3 mt-xl-4">
                    <div class="video-youtybe-container ">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/8ZH2zG-ruMI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <h3 class="mt-2 text-center">
                    <a href="" class="smooth fs-20 robotob hv-main-sp" title="">Đẻ là đến Phương Đông - Đẻ gì mà sướng ghê!</a>
                </h3>
            </div>
            @if (count($newsRelateds) > 0)
                <div class="relate-new">
                    <p class="side-bar-title robotob wow fadeInUp">BÀI VIẾT CÙNG CHỦ ĐỀ</p>
                    @foreach (array_slice($newsRelateds,0,1) as $item)
                        <div class="relate-new-big d-flex flex-wrap mt-3 mt-lg-4 pb-3 pb-lg-4 wow fadeInUp">
                            <div class="img order-md-2">
                                <a href="{{$item->slug}}" class="c-img shine-effect" title="{{$item->name}}">
                                    <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                                </a>
                            </div>
                            <div class="content">
                                <h3>
                                    <a href="{{$item->slug}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                                </h3>
                                <p class="fs-16-cv my-1 my-xl-2">{{Str::words($item->short_content,'28')}}</p>
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="item-time mt-1 me-3">
                                        <span>{{\Support::showDate($item->time_published,'d/m/Y H:i')}}</span>
                                    </div>
                                    @if (isset($parent))
                                        <div class="new-cate-info mt-1">
                                            <a href="{{$parent->slug}}" class="smooth text-uppercase" title="{{$parent->name}}">{{$parent->name}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="relate-item">
                        @foreach (array_slice($newsRelateds,1,4) as $item)
                            <div class="relate-new-small d-flex flex-wrap py-3 wow fadeInUp">
                                <div class="img order-md-2">
                                    <a href="{{$item->slug}}" class="c-img shine-effect" title="{{$item->name}}">
                                        <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                                    </a>
                                </div>
                                <div class="content">
                                    <h3>
                                        <a href="{{$item->slug}}" class="smooth hv-main-sp fs-20-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                                    </h3>
                                    <p class="fs-16-cv my-1">{{Str::words($item->short_content,'28')}}</p>
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="item-time mt-1 me-3">
                                            <span>{{\Support::showDate($item->time_published,'d/m/Y H:i')}}</span>
                                        </div>
                                        @if (isset($parent))
                                            <div class="new-cate-info mt-1">
                                                <a href="{{$parent->slug}}" class="smooth text-uppercase" title="{{$parent->name}}">{{$parent->name}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
             @endif
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop
@section('jsl')
    <script src="frontend/js/share-btn.js" defer></script>
    <script src="{{asset('frontend/js/comment/xhr.js')}}" defer></script>
    <script src="{{asset('frontend/js/comment/comment.js')}}" defer></script>
@stop