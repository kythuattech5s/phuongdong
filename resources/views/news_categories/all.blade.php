@extends('index')
@section('content')
<section class="container mt-xl-2">
	{{\Breadcrumbs::render('static',$currentItem->vi_name,$currentItem->vi_link)}}
</section>
<section class="container">
    <h1 class="fs-30-cv robotob mb-1">{{$currentItem->vi_name}}</h1>
	<div class="position-relative list-pathology-cate pt-4 px-4">
        <div class="swiper-container slide-pathology wow fadeInUp">
            <div class="swiper-wrapper">
               	@foreach ($listCateChild as $itemCate)
               		<div class="swiper-slide p-1">
                        <a href="{{Support::show($itemCate, 'slug')}}" class="item-pathology text-center cspoint" title="{{$itemCate->name}}">
                            <div class="img smooth d-flex align-items-center mx-auto justify-content-center">
                                <img src="{%IMGV2.itemCate.icon.-1%}" alt="{{$itemCate->name}}">
                            </div>
                            <p class="name smooth fs-12 robotob text-uppercase mt-2">{{$itemCate->name}}</p>
                        </a>
                    </div>
               	@endforeach
            </div>
        </div>
        <div class="slider-controls">
            <button class="slide-pathology-prev prev-btn">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>
            <button class="slide-pathology-next next-btn">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</section>
<section class="shadow-box-top py-4 mt-4">
    <div class="container">
        @foreach ($listCateChild as $itemCate)
        	@php
        		$listNews = $itemCate->news()->publish()->act()->Ord()->take(7)->get()->all();
        	@endphp
        	@if (count($listNews) > 0)
	            <div class="py-2 py-xxl-3">
	                <h2 class="all-sub-title wow fadeInUp mb-3"><a href="{{Support::show($itemCate, 'slug')}}" class="smooth" title="{{$itemCate->name}}">{{$itemCate->name}}</a></h2>
	                @include('news.news_module',['listNews'=>$listNews])
	            </div>
        	@endif
        @endforeach
    </div>
</section>
@stop