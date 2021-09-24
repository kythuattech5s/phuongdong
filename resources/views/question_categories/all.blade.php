@extends('index')
@section('content')
<section class="container">
    <div class="mb-2 pt-xl-2">
        {{\Breadcrumbs::render('static','Hỏi đáp chuyên gia','hoi-dap-chuyen-gia')}}
    </div>
    <div class="row">
        <div class="col-lg-8 col-xl-72 mb-4 order-lg-2">
            <div class="module-form-search-question justify-content-between d-flex flex-wrap align-items-center wow fadeInUp mb-4">
                <form class="form-search-question position-relative my-2" action="{{VRoute::get('searchQuestion')}}" method="get" accept-charset="utf8">
                    <input type="text" name="q" placeholder="Tìm theo câu hỏi, chủ đề">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
                <a href="{{VRoute::get('makeQuestion')}}" class="btn-all btn-all-main my-2" title="Gửi câu hỏi"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Gửi câu hỏi</a>
            </div>
            <h1 class="fs-30-cv robotob wow fadeInUp">Hỏi đáp chuyên gia</h1>
            @foreach ($listItems as $key => $item)
                @if ($key > 0)
                    @include('question.item')
                @else
                    @include('question.item_big')
                @endif
            @endforeach
            <div class="pagenigation mb-2 mt-3 mt-xl-4">
                {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
            </div>
        </div>
        <div class="col-lg-4 col-xl-28 mb-4">
            @include('question_categories.sidebar')
        </div>
    </div>
</section>
@stop