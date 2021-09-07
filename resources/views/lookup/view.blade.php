@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-72 shadow-box-right pt-1 pb-md-4 pb-xxl-5 pe-xxl-5">
            <ul class="breadcrumb">
                {{\Breadcrumbs::render('drug_lookup',$currentItem)}}
            </ul>
            <h1 class="fs-30-cv robotob mb-1 lh-13 wow fadeInUp">{{$currentItem->name}}</h1>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$currentItem->content!!}
            </div>
        </div>
        <div class="col-lg-4 col-xl-28 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop