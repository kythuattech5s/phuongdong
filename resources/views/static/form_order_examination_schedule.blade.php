<form class="form-contact-main form-send-contact h-100" action="{{VRoute::get('bookApointment')}}" method="post" accept-charset="utf8" autocomplete="off">
    <div class="header-form text-center py-2 py-lg-4">
        <p class="fs-30-cv text-uppercase robotob">Đặt lịch khám chữa bệnh</p>
        <p class="fs-16 px-3 px-xl-5 mx-xl-4 mt-xl-3">{[form_book_content]}</p>
    </div>
    <div class="form-content p-3 pt-xl-4 p-xl-4">
        <input type="text" name="fullname" placeholder="Họ và tên (*)">
        <input type="text" name="phone" placeholder="Số điện thoại (*)">
        <input type="email" name="email" placeholder="Email">
        <div id="datepicker-medical{{isset($datepick_2) ? $datepick_2:''}}" class="input-group date" data-date-format="mm-dd-yyyy">
            <input class="form-control" name="day_book" type="text" placeholder="Ngày đặt">
            <span class="input-group-addon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </span>
        </div>
        <div class="list-time-pick pb-1">
            <p class="fs-16 mb-1 robotob clmain">LỊCH KHÁM</p>
            <div class="d-flex justify-content-between flex-wrap">
                @foreach ($listTimePick as $itemTime)
                    <div class="item-time-pick">
                        <label class="w-100">
                            <input type="radio" value="{{$itemTime->id}}" class="d-none" name="time_pick">
                            <span>{{$itemTime->name}}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <select name="service">
        	<option value="0">Chọn dịch vụ khám</option>
        	@foreach ($listService as $item)
        		<option value="{{$item->id}}">{{$item->name}}</option>
        	@endforeach
        </select>
        <select name="doctor">
        	<option value="0">Chọn bác sĩ</option>
        	@foreach ($listDoctor as $item)
        		<option value="{{$item->id}}">{{$item->name}}</option>
        	@endforeach
        </select>
        <textarea name="note" rows="4" placeholder="Nhu cầu khám bệnh"></textarea>
        <div class="text-center">
            <button type="submit" class="btn-all btn-all-main btn-small text-uppercase py-2 px-xl-5 fs-16">Gửi yêu cầu</button>
        </div>
    </div>
</form>