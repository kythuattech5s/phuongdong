@extends('index')
@section('content')
<section class="container mt-xl-2">
    {{\Breadcrumbs::render('static','Đặt câu hỏi','dat-cau-hoi')}}
    <div class="row pb-4 pb-xl-5 pt-lg-3">
        <div class="col-lg-7 pe-lg-5 mt-4">
            <form class="form-contact-main form-send-contact h-100 wow fadeInUp" action="{{VRoute::get('resgisterAdvise')}}" method="post" accept-charset="utf8" autocomplete="off">
			    <div class="header-form text-center py-2 py-lg-4">
			        <p class="fs-30-cv text-uppercase robotob">Đặt câu hỏi</p>
			        <p class="fs-16 px-3 px-xl-5 mx-xl-4 mt-xl-3">{[form_question_content]}</p>
			    </div>
			    <div class="form-content p-3 pt-xl-4 p-xl-4">
			        <div class="row">
			        	<div class="col-lg-8">
			        		<input type="text" name="fullname" placeholder="Họ và tên (*)">
			        	</div>
			        	<div class="col-lg-4">
			        		<input type="text" name="age" placeholder="Tuổi (*)">
			        	</div>
			        </div>
			        <input type="text" name="phone" placeholder="Số điện thoại (*)">
			        <input type="email" name="email" placeholder="Email (*)">
			        <select name="specialists">
			        	<option value="0">Chọn Chuyên khoa (*)</option>
			        	@foreach ($listSpecialist as $item)
			        		<option value="{{$item->id}}">{{$item->name}}</option>
			        	@endforeach
			        </select>
			        <input type="text" name="title" placeholder="Tiêu đề (*)">
			        <textarea name="note" rows="4" placeholder="Nội dung"></textarea>
			        <div class="text-center">
			            <button type="submit" class="btn-all btn-all-main btn-small text-uppercase py-2 px-xl-5 fs-16">Gửi yêu cầu</button>
			        </div>
			    </div>
			</form>
        </div>
        <div class="col-lg-5 mt-4">
            @include('static.hotline_bg')
        </div>
    </div>
</section>
@stop