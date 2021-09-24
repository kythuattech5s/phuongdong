@extends('index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/comment.css')}}">
@endsection
@section('content')
<section class="container pt-xl-2">
    {{\Breadcrumbs::render('static','Tìm kiếm bác sĩ','tim-kiem-bac-si')}}
    <div class="border-top mt-2">
    </div>
    <div class="row">
        <div class="col-lg-8 shadow-box-right py-3 py-md-4 pe-lg-4">
            <h1 class="fs-30-cv robotob wow fadeInUp">Tìm kiếm bác sĩ với từ khóa : {{$q}}</h1>
            @if (count($listItems) > 0)
                <div class="list-doctor mt-3 mt-lg-4">
                    @foreach ($listItems as $itemDoctor)
                        @include('doctors.item')
                    @endforeach
                </div>
                <div class="pagenigation mb-2 mt-4">
                    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
                </div>
            @else
                <p class="fs-18 mt-3 wow fadeInUp">Không có kết quả nào phù hợp</p>
            @endif
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('doctors.sidebar')
        </div>
    </div>
</section>
@stop