@extends('index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/comment.css') }}">
@endsection
@section('content')
<section class="container">
    <div class="mb-2 pt-xl-2">
        {{\Breadcrumbs::render('question',$currentItem,$parent)}}
    </div>
    <div class="row">
        <div class="col-lg-8 col-xl-72 mb-4 order-lg-2">
            <h1 class="fs-30-cv robotob wow fadeInUp">{{$currentItem->name}}</h1>
            <div class="question-main-image position-relative mt-4 pt-xl-2 mb-3 mx-auto wow fadeInUp">
                @include('image_loader.big',['itemImage'=>$currentItem])
                <a href="{%IMGV2.currentItem.img.-1%}" data-fancybox class="smooth icon" title="{{$currentItem->name}}">
                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                </a>
            </div>
            <p class="text-center fs-15 wow fadeInUp">{{$currentItem->name}}</p>
            <div class="item-question mt-4 wow fadeInUp pt-xl-2 mb-3">
                <div class="title-question d-flex flex-wrap align-items-center mb-2">
                    @if (isset($parent))
                        <a href="{{Support::show($parent, 'slug')}}" class="theme me-4 mb-1" title="{{$parent->name}}">
                            <i class="fa fa-question-circle fs-16 me-1" aria-hidden="true"></i>
                            <span>Hỏi về: <span class="text-uppercase">{{$parent->name}}</span></span>
                        </a>
                    @endif
                    <p class="fs-18 me-4 mb-1">
                        <span>Khách hàng:</span>
                        <span class="robotob clsp">{{$currentItem->customer_name}}</span>
                    </p>
                    <p class="fs-15 mb-1">
                        Đã hỏi: Ngày {{\Support::showDate($currentItem->time_ask)}}
                    </p>
                </div>
                <div class="s-content fs-16">
                    {!!$currentItem->question!!}
                </div>
            </div>
            <div class="border-top wow fadeInUp"></div>
            <div class="item-question-answer wow fadeInUp mt-3">
                <div class="logo">
                    <img src="{Ilogo.imgI}" title="{Ilogo.titleI}" alt="{Ilogo.altI}" class="img-fluid">
                </div>
                <div class="title-question-answer mb-2">
                    @if (isset($doctor))
                        <div class="mt-3 d-flex">
                            <span class="icon">
                                <img src="frontend/images/icon_doctor.png" title="" alt="" class="img-fluid smooth">
                            </span>
                            <span class="ms-1 d-inline-block robotob fs-18 pt-1 lh-13">{{$doctor->academic_rank}} {{$doctor->name}} - {{$doctor->position}}</span>
                        </div>
                    @endif
                    <p class="fs-15 mt-1">Đã trả lời: Ngày {{\Support::showDate($currentItem->time_reply)}}
                        @if (isset($parent))
                            / Chủ đề: <a href="{{Support::show($parent, 'slug')}}" class="robotob hv-sp" title="{{$parent->name}}">{{$parent->name}}</a>
                        @endif
                     </p>
                </div>
                <div class="s-content fs-16">
                    {!!$currentItem->answer!!}
                </div>
            </div>
            <div class="message wow fadeInUp">
                @php
                    $ratings = $currentItem->getRating('all');
                @endphp
                <div class="comment-box mt-4">
                    @include('path.comment_box',['map_table' => 'questions'])
                </div>
            </div>
            @if (count($questionRelateds) > 0)
                <p class="side-bar-title robotob wow fadeInUp mt-4 pt-xl-2">CÂU HỎI CÙNG CHỦ ĐỀ</p>
                @foreach (array_slice($questionRelateds,0,1) as $item)
                    <div class="question-big d-flex flex-wrap pb-3 pb-xxl-4 mt-3 pt-xl-2 wow fadeInUp">
                        <div class="img">
                            <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                                @include('image_loader.big',['itemImage'=>$item])
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                            </h3>
                            @php
                                $parentItem = $item->category()->act()->first();
                            @endphp
                            @if (isset($parentItem))
                                <h2 class="my-2"><a href="{{Support::show($parentItem, 'slug')}}" class="smooth theme-question-name text-uppercase" title="{{$parentItem->name}}">{{$parentItem->name}}</a></h2>
                            @endif
                            <p class="fs-16-cv">{{$item->short_content}}</p>
                            <div class="time fs-15 mt-2">
                                Đã hỏi: Ngày {{\Support::showDate($item->time_ask)}}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="relate-item">
                    @foreach (array_slice($questionRelateds,1,4) as $item)
                        <div class="relate-new-small d-flex flex-wrap py-3 wow fadeInUp">
                            <div class="img order-lg-2">
                                <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                                    @include('image_loader.big',['itemImage'=>$item])
                                </a>
                            </div>
                            <div class="content">
                                 <h3>
                                    <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-20-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                                </h3>
                                @php
                                    $parentItem = $item->category()->act()->first();
                                @endphp
                                @if (isset($parentItem))
                                    <h2 class="my-1"><a href="{{Support::show($parentItem, 'slug')}}" class="smooth theme-question-name text-uppercase" title="{{$parentItem->name}}">{{$parentItem->name}}</a></h2>
                                @endif
                                <p class="fs-16-cv lg-13">{{$item->short_content}}</p>
                                <div class="time fs-15 mt-2">
                                    Đã hỏi: {{\Support::showDate($item->time_ask)}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="col-lg-4 col-xl-28 mb-4">
            @include('question_categories.sidebar')
        </div>
    </div>
</section>
@stop
@section('js')
    <script src="{{ asset('frontend/js/comment/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('frontend/js/comment/xhr.js') }}"></script>
    <script src="{{ asset('frontend/js/comment/comment.js') }}"></script>
    <script src="{{ asset('frontend/js/comment/validatorIMG.js') }}"></script>
@endsection