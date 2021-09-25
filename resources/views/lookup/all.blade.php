@extends('index')
@section('content')
<section class="container pt-xl-2 pb-4">
    {{\Breadcrumbs::render('static',$currentItem->vi_name,$currentItem->vi_link)}}
    <h1 class="fs-30-cv robotob wow fadeInUp">
        Tìm hiểu về các loại 
        <?php
            switch ($currentItem->table) {
                case 'drug_lookups':
                    echo 'thuốc';
                    break;
                case 'body_lookups':
                    echo 'cơ thể';
                    break;
                case 'disease_lookups':
                    echo 'bệnh';
                    break;
                default:
                    break;
            }
        ?>
        theo bảng chữ cái
    </h1>
    <div class="list-character px-xl-5 ms-3 mt-3 mt-xl-4 wow fadeInUp">
        @foreach (range('A', 'Z') as $item)
            <div class="item-character" data-key="{{$item}}">
                <span class="notranslate">{{$item}}</span>
            </div>
        @endforeach
    </div>
    <p class="fs-18 robotob py-3 wow fadeInUp">Được tìm kiếm nhiều nhất</p>
    <ul class="list-item-search wow fadeInUp">
        @foreach ($listHots as $item)
            <li><a href="{{Support::show($item, 'slug')}}" class="smooth" title="{{$item->name}}">{{$item->name}}</a></li>
        @endforeach
    </ul>
    @foreach (range('A', 'Z') as $item)
        <div class="section-item-search mt-3 mt-xl-4 pt-2" id="{{$item}}">
            <div class="header-item-search d-flex justify-content-between align-items-end mb-4">
                <span class="fs-30-cv mb-1 notranslate">{{$item}}</span>
                <button href="" class="smooth mb-1 hv-main-sp back-first-page" title="">
                    <span class="me-1">Trở về trang đầu</span>
                    <i class="fa fa-arrow-circle-up fs-18 clmain" aria-hidden="true"></i>
                </button>
            </div>
            <ul class="list-item-search">
                @foreach ($listItems as $itemLookup)
                    @if ($item == strtoupper($itemLookup->name[0]))
                        <li><a href="{{Support::show($itemLookup, 'slug')}}" class="smooth" title="{{$itemLookup->name}}">{{$itemLookup->name}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endforeach
</section>
@stop