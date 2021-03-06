@extends('index')
@section('content')
<section class="container pt-2 pb-4 pb-xl-5">
    {{\Breadcrumbs::render('static','Dịch vụ y tế','dich-vu-y-te')}}
    <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">Dịch vụ khám chữa bệnh</h1>
    <p class="fs-16 wow fadeInUp">Với sứ mệnh “Nâng niu từng sự sống”, Bệnh viện Đa khoa Phương Đông mang đến những dịch vụ chăm sóc sức khỏe tốt nhất cùng chính sách giá cả hợp lý tạo nên sự an tâm và hài lòng cho mỗi khách hàng.</p>
    <div class="row gx-3 gx-lg-4 mt-4 pt-xl-2">
        @foreach ($listItems as $item)
            <div class="col-6 col-lg-4 mb-3 mb-lg-4">
                <div class="item-cate-service wow fadeInUp">
                    <div class="img">
                        <a href="{{$item->slug}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                            <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                        </a>
                    </div>
                    <div class="content">
                        <h2 class="name">
                            <a href="{{$item->slug}}" class="smooth title-hover-border" title="{{$item->name}}">{{$item->name}}</a>
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