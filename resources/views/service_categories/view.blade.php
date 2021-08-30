@extends('index')
@section('content')
<section class="container pt-2 pb-4 pb-xl-5">
    {{\Breadcrumbs::render('service_category',$currentItem)}}
    <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">{{$currentItem->name}}</h1>
    <p class="fs-16 wow fadeInUp">{{$currentItem->short_content}}</p>
    <div class="row gx-3 mt-4 pt-xl-2">
        @foreach ($listItems as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="item-cate-service-sub wow fadeInUp">
                    <div class="img">
                        <a href="{{$item->slug}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                            <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                        </a>
                    </div>
                    <div class="content">
                        <h2 class="name">
                            <a href="{{$item->slug}}" class="smooth fs-24-cv hv-main-sp robotob" title="{{$item->name}}">{{$item->name}}</a>
                        </h2>
                        <div class="short_content fs-16-cv my-1 my-lg-2">
                            {{Str::words($item->short_content,'25')}}
                        </div>
                        <a href="{{$item->slug}}" class="hv-icon btn-view-all d-inline-block"title="{{$item->slug}}">
                            <i class="fa fa-plus-circle fs-22" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagenigation mb-2 mt-3 mt-xl-4">
        {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
    </div>
</section>
@stop