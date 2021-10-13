@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 shadow-box-right pt-xl-2 pb-md-4 pb-xxl-5 pe-xxl-5">
            {{\Breadcrumbs::render('file_gallery',$currentItem,$parent)}}
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
            <div class="my-3 wow fadeInUp">
                <a href="{%IMGV2.currentItem.file.-1%}" download class="btn-all btn-all-main px-4 pb-1 pt-2" title="Tải về">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    Tải về
                </a>
            </div>
            <div class="short-content-new fs-16 wow fadeInUp" data-wow-delay="0.3s">
                {{$currentItem->short_content}}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$currentItem->content!!}
            </div>
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop