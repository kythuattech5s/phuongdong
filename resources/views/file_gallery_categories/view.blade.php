@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 shadow-box-right pb-3 pb-md-4 pt-xl-2 pe-xxl-5">
            {{\Breadcrumbs::render('file_gallery_category',$currentItem)}}
            <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">{{$currentItem->name}}</h1>
            <p class="fs-16-cv wow fadeInUp">{{$currentItem->short_content}}</p>
            @foreach ($listItems as $key => $item)
                @if ($key < 1)
                    <div class="gallery-big d-flex flex-wrap align-items-start pt-3 pt-xxl-4 wow fadeInUp">
                        <div class="img position-relative">
                            <a href="{{Support::show($item, 'slug')}}" class="smooth c-img c-img-file shine-effect" title="{{$item->name}}">
                                @if ($item->img != '')
                                    @include('image_loader.big',['itemImage'=>$item])
                                @else
                                    @php
                                        $fileInfo = json_decode($item->file,true);
                                    @endphp
                                    @if (isset($fileInfo['name']))
                                        <img src="frontend/images/{{pathinfo($fileInfo['name'])['extension']}}.png" title="" alt="" class="img-fluid">
                                    @endif
                                @endif
                            </a>
                            <div class="icon">
                                <i class="fa fa-file" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                            </h3>
                            <p class="fs-16-cv my-2 my-xl-3">{{Str::words($item->short_content,'35')}}</p>
                            <div class="item-time mt-1">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>{{\Support::showDate($item->created_at)}}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="row gx-lg-4">
                @foreach ($listItems as $key => $item)
                    @if ($key >= 1)
                        <div class="col-6 col-lg-4 mt-3 mt-xl-4 wow fadeInUp">
                            @include('file_gallery.item')
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="pagenigation mb-2 mt-3 mt-xl-4">
                {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
            </div>
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop