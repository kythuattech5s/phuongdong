@extends('index')
@section('content')
<section class="container pt-xl-2 pb-4 pb-xl-5">
    {{\Breadcrumbs::render('static','Dịch vụ y tế','dich-vu-y-te')}}
    <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">Dịch vụ khám chữa bệnh</h1>
    <p class="fs-16 wow fadeInUp">{[service_page_content]}</p>
    <div class="row gx-3 gx-lg-4 mt-4 pt-xl-2">
        @foreach ($listItems as $item)
            <div class="col-6 col-lg-4 mb-3 mb-lg-4">
                <div class="item-cate-service wow fadeInUp">
                    <div class="img">
                        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                            @include('image_loader.big',['itemImage'=>$item])
                        </a>
                    </div>
                    <div class="content">
                        <h2 class="name">
                            <a href="{{Support::show($item, 'slug')}}" class="smooth title-hover-border" title="{{$item->name}}">{{$item->name}}</a>
                        </h2>
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