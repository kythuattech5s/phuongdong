@extends('index')
@section('content')
<section class="main_breadcrumb">
    <div class="container">
        {{\Breadcrumbs::render('static','Tìm kiếm',VRoute::get('search'))}}
    </div>
</section><section class="pb-4 pb-xl-5">
    <div class="container">
        <h1 class="text-uppercase fs-26-cv robotob wow fadeInUp">Kết quả tìm kiếm với từ khóa: <span class="clmain">{{$val}}</span></h1>
        <p class="fs-18-cv my-3 robotob wow fadeInUp">Tin tức</p>
        <div class="module-paginate-ajax wow fadeInUp" data-action="{{VRoute::get('searchItem')}}?type=news&q={{$val}}">
            
        </div>
        <p class="fs-18-cv my-3 robotob wow fadeInUp">Dịch vụ</p>
        <div class="module-paginate-ajax wow fadeInUp" data-action="{{VRoute::get('searchItem')}}?type=service&q={{$val}}">
            
        </div>
        <p class="fs-18-cv my-3 robotob wow fadeInUp">Chuyên khoa</p>
        <div class="module-paginate-ajax wow fadeInUp" data-action="{{VRoute::get('searchItem')}}?type=specialist&q={{$val}}">
            
        </div>
        <p class="fs-18-cv my-3 robotob wow fadeInUp">Bác sĩ</p>
        <div class="module-paginate-ajax wow fadeInUp" data-action="{{VRoute::get('searchItem')}}?type=doctor&q={{$val}}">
            
        </div>
    </div>
</section>
@stop