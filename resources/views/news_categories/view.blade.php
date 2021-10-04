@extends('index')
@section('content')
@if (count($listCateChild) > 0)
	<section class="container mt-xl-2">
	    {{\Breadcrumbs::render('news_category',$currentItem)}}
	</section>
	<section class="container">
	    <h1 class="fs-30-cv robotob mb-1">{{$currentItem->seo_title != '' ? $currentItem->seo_title:$currentItem->name}}</h1>
	    <div class="fs-16">{!!$currentItem->seo_des!!}</div>
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
	        @foreach ($listCateChildShow as $itemCate)
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
@else
	<div class="container">
		<div class="row">
		    <div class="col-lg-8 shadow-box-right pb-3 pb-md-4 pt-xl-2 pe-lg-4">
		        {{\Breadcrumbs::render('news_category',$currentItem)}}
		        <h1 class="fs-30-cv robotob mb-1 wow fadeInUp lh-13">{{$currentItem->seo_title != '' ? $currentItem->seo_title:$currentItem->name}}</h1>
		        <div class="fs-16 wow fadeInUp">{!!$currentItem->seo_des!!}</div>
		        @foreach ($listItems as $key => $item)
		            @if ($key < 1)
		                <div class="new-big d-flex flex-wrap py-3 py-xxl-4 wow fadeInUp">
		                    <div class="img">
		                        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
		                            @include('image_loader.big',['itemImage'=>$item])
		                        </a>
		                    </div>
		                    <div class="content">
		                        <h3>
		                            <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
		                        </h3>
		                        <p class="fs-16-cv my-2 my-xl-3">{{Str::words($item->seo_des,'50')}}</p>
		                        <div class="item-time mt-1">
		                            <i class="fa fa-calendar" aria-hidden="true"></i>
		                            <span>{{\Support::showDate($item->created_at)}}</span>
		                        </div>
		                    </div>
		                </div>
		            @endif
		        @endforeach
		        @foreach ($listItems as $key => $item)
		            @if ($key >= 1)
		                @include('news.item')
		            @endif
		        @endforeach
		        <div class="pagenigation mb-2 mt-3 mt-xl-4">
		            {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
		        </div>
		    </div>
		    <div class="col-lg-4 ps-lg-4">
		        @include('news_categories.sidebar')
		    </div>
		</div>
	</div>
@endif
@stop