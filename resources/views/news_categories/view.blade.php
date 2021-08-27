@extends('index')
@section('content')
<section class="container mt-xl-2">
    {{\Breadcrumbs::render('news_category',$currentItem)}}
</section>
<section class="container">
    <h1 class="fs-30-cv robotob mb-1">{{$currentItem->name}}</h1>
    <p class="fs-16">{{$currentItem->short_content}}</p>
    @if (count($listCateChild) > 0)
    	<div class="position-relative list-pathology-cate pt-4 px-4">
	        <div class="swiper-container slide-pathology wow fadeInUp">
	            <div class="swiper-wrapper">
	               	@foreach ($listCateChild as $itemCate)
	               		<div class="swiper-slide p-1">
	                        <a href="{{$itemCate->slug}}" class="item-pathology text-center cspoint" title="{{$itemCate->name}}">
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
    @endif
</section>
<section class="shadow-box-top py-4 mt-4">
    <div class="container">
        @foreach ($listCateChildShow as $itemCate)
            <div class="py-2 py-xxl-3">
                <h2 class="all-sub-title wow fadeInUp mb-3"><a href="" class="smooth" title="">Sản phụ - phụ khoa</a></h2>
                @include('news.news_module',['news'])
            </div>
        @endforeach
    </div>
</section>
@stop