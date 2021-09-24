@extends('index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/comment.css')}}">
@endsection
@section('content')
<section class="container pt-xl-2">
    {{\Breadcrumbs::render('static','Đội ngũ bác sĩ','doi-ngu-bac-si')}}
    <div class="border-top mt-2">
    </div>
    <div class="row">
        <div class="col-lg-8 shadow-box-right py-3 py-md-4 pe-lg-4">
            <h1 class="fs-30-cv robotob wow fadeInUp">{[doctor_page_title]}</h1>
            <p class="fs-16-cv wow fadeInUp">{[doctor_page_content]}</p>
            <div class="list-doctor mt-3 mt-lg-4">
                @foreach ($listItems as $itemDoctor)
                    @include('doctors.item')
                @endforeach
            </div>
            <div class="pagenigation mb-2 mt-4">
                {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
            </div>
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('doctors.sidebar')
        </div>
    </div>
</section>
@stop