@extends('index')
@section('content')
<section class="container pt-3 pb-4">
    {{\Breadcrumbs::render('static','Thư viện ảnh','thu-vien-anh')}}
    <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">Thư viện ảnh</h1>
    <div class="fs-16 wow fadeInUp">
        Bệnh viện Đa khoa Phương Đông quy tụ đội ngũ chuyên gia, giáo sư, bác sĩ đầu ngành, có nhiều năm kinh nghiệm công tác tại các bệnh viện tuyến đầu trong cả nước và tu nghiệp tại các trung tâm chăm sóc sức khỏe, bệnh viện lớn ở nước ngoài.
    </div>
</section>
<section class="hot-galley container">
    
</section>
<section class="container pt-3 pb-lg-4">
    @foreach ($listItems as $itemCate)
        @php
            $listItemGallery = $itemCate->imageGallery()->act()->take(3)->get();
        @endphp
        @if ($listItemGallery->count() > 0)
            <div class="item-gallery-category mb-4 wow fadeInUp">
                <h2><a href="{{$itemCate->slug}}" class="smooth fs-21-cv robotob text-uppercase" title="{{$itemCate->name}}">{{$itemCate->name}}</a></h2>
                <div class="row mt-2">
                    @foreach ($listItemGallery as $item)
                        <div class="col-sm-6 col-lg-4 mb-3">
                            @include('image_gallery.item')
                        </div>
                    @endforeach
                </div>
                <div class="view-more position-relative text-center mt-2">
                    <a href="{{$itemCate->slug}}" class="smooth" title="Xem tất cả">Xem tất cả</a>
                </div>
            </div>
        @endif
    @endforeach
</section>
@stop