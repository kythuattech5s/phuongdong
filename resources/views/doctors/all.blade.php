@extends('index')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/comment.css')}}">
@endsection
@section('content')
<section class="container">
    {{\Breadcrumbs::render('static','Đội ngũ bác sĩ','doi-ngu-bac-si')}}
    <div class="border-top mt-2">
    </div>
    <div class="row">
        <div class="col-lg-8 shadow-box-right py-3 py-md-4 pe-lg-4">
            <h1 class="fs-30-cv robotob wow fadeInUp">Đội ngũ Bác sĩ Bệnh viện Đa Khoa Phương Đông</h1>
            <p class="fs-16-cv wow fadeInUp">Bệnh viện Đa khoa Phương Đông quy tụ đội ngũ chuyên gia, giáo sư, bác sĩ đầu ngành, có nhiều năm kinh nghiệm công tác tại các bệnh viện tuyến đầu trong cả nước và tu nghiệp tại các trung tâm chăm sóc sức khỏe, bệnh viện lớn ở nước ngoài.</p>
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