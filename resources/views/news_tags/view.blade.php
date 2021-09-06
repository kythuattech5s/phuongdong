@extends('index')
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col-lg-8 shadow-box-right py-3 py-md-4 pe-lg-4">
		        {{\Breadcrumbs::render('news_category',$currentItem)}}
		        <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">{{$currentItem->name}}</h1>
		        <p class="fs-16 wow fadeInUp">{{$currentItem->short_content}}</p>
		        @foreach ($listItems as $key => $item)
		            @if ($key < 1)
		                <div class="new-big d-flex flex-wrap py-3 py-xxl-4 wow fadeInUp">
		                    <div class="img">
		                        <a href="{{$item->slug}}" class="smooth c-img shine-effect" title="{{$item->name}}">
		                            <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
		                        </a>
		                    </div>
		                    <div class="content">
		                        <h3>
		                            <a href="{{$item->slug}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
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
		                <div class="new-medium d-flex flex-wrap py-3 py-xxl-4 wow fadeInUp">
		                    <div class="img">
		                         <a href="{{$item->slug}}" class="smooth c-img shine-effect" title="{{$item->name}}">
		                            <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
		                        </a>
		                    </div>
		                    <div class="content">
		                        <h3>
		                            <a href="{{$item->slug}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
		                        </h3>
		                        <p class="fs-16-cv my-1 my-xl-2">{{Str::words($item->short_content,'35')}}</p>
		                        <div class="item-time mt-1">
		                            <i class="fa fa-calendar" aria-hidden="true"></i>
		                            <span>{{\Support::showDate($item->created_at)}}</span>
		                        </div>
		                    </div>
		                </div>
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