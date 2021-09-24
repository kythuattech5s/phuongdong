@extends('index')
@section('content')
<div class="container">
	<div class="row">
	    <div class="col-lg-8 shadow-box-right pb-3 pb-md-4 pt-xl-2 pe-lg-4">
	        {{\Breadcrumbs::render('static','Tin tức','tin-tuc')}}
	        <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">Tin tức</h1>
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
	                        <p class="fs-16-cv my-2 my-xl-3">{{Str::words($item->short_content,'50')}}</p>
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
@stop