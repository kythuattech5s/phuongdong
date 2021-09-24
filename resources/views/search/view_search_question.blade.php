@extends('index')
@section('content')
<section class="container">
    <div class="mb-2 pt-xl-2">
        {{\Breadcrumbs::render('static','Tìm kiếm câu hỏi','tim-kiem-cau-hoi')}}
    </div>
    <div class="row">
        <div class="col-lg-8 col-xl-72 mb-4 order-lg-2">
            <h1 class="fs-30-cv robotob wow fadeInUp">Tìm kiếm câu hỏi với từ khóa : {{$q}}</h1>
            @if (count($listItems) > 0)
                @foreach ($listItems as $key => $item)
                    @include('question.item')
                @endforeach
                <div class="pagenigation mb-2 mt-3 mt-xl-4">
                    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
                </div>
            @else
                <p class="fs-18 mt-3 wow fadeInUp">Không có kết quả nào phù hợp</p>
            @endif
        </div>
        <div class="col-lg-4 col-xl-28 mb-4">
            @include('question_categories.sidebar')
        </div>
    </div>
</section>
@stop