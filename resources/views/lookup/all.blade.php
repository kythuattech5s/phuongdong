@extends('index')
@section('content')
<section class="container pt-2 pb-4">
    {{\Breadcrumbs::render('static','Tra cứu thuốc','tra-cuu-thuoc')}}
    <h1 class="fs-30-cv robotob wow fadeInUp">Tìm hiểu về các loại thuốc theo bảng chữ cái</h1>
    <div class="list-character px-xl-5 ms-3 mt-3 mt-xl-4 wow fadeInUp">
        @foreach (range('A', 'Z') as $item)
            <div class="item-character" data-key="{{$item}}">
                <span>{{$item}}</span>
            </div>
        @endforeach
    </div>
    <p class="fs-18 robotob py-3 wow fadeInUp">Cơ thể được tìm kiếm nhiều nhất</p>
    <ul class="list-item-search wow fadeInUp">
        @foreach ($listHots as $item)
            <li><a href="{{$item->slug}}" class="smooth" title="{{$item->name}}">{{$item->name}}</a></li>
        @endforeach
    </ul>
    @foreach (range('A', 'Z') as $item)
        <div class="section-item-search mt-3 mt-xl-4 pt-2" id="{{$item}}">
            <div class="header-item-search d-flex justify-content-between align-items-end mb-4">
                <span class="fs-30-cv mb-1">{{$item}}</span>
                <a href="" class="smooth mb-1 hv-main-sp" title="">
                    <span class="me-1">Trở về trang đầu</span>
                    <i class="fa fa-arrow-circle-up fs-18 clmain" aria-hidden="true"></i>
                </a>
            </div>
            <ul class="list-item-search wow fadeInUp">
                @foreach ($listItems as $itemLookup)
                    @if ($item == strtoupper($itemLookup->name[0]))
                        <li><a href="{{$itemLookup->slug}}" class="smooth" title="{{$itemLookup->name}}">{{$itemLookup->name}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endforeach
</section>
@stop