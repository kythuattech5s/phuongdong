@extends('index')
@section('content')
<section class="container pt-xl-2 pb-4 pb-xl-5">
    {{\Breadcrumbs::render('service_category',$currentItem)}}
    <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">{{$currentItem->name}}</h1>
    <p class="fs-16 wow fadeInUp">{{$currentItem->short_content}}</p>
    <div class="row gx-3 mt-4 pt-xl-2">
        @foreach ($listItems as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                @include('services.item')
            </div>
        @endforeach
    </div>
    <div class="pagenigation mb-2 mt-3 mt-xl-4">
        {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
    </div>
</section>
@stop