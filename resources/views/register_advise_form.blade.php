<form class="form-contact-sidebar form-send-contact mt-4 wow fadeInUp" action="{{VRoute::get('resgisterAdvise')}}" method="post" accept-charset="utf8" autocomplete="off">
    <div class="header-form text-center py-2 lh-13">
        <p class="fs-22 text-uppercase robotob">Đăng ký tư vấn</p>
        <p class="fs-16 px-3">Đặt hẹn ngay để nhận tư vấn và xếp lịch khám kịp thời</p>
    </div>
    <div class="form-content p-3 pt-xl-4">
        <input type="hidden" name="type" value="1">
        <input type="text" name="fullname" placeholder="Họ và tên (*)">
        <input type="text" name="phone" placeholder="Số điện thoại (*)">
        <input type="email" name="email" placeholder="Email">
        <textarea name="note" rows="2" placeholder="Nội dung"></textarea>
        <div class="text-center">
            <button type="submit" class="btn-all btn-all-main btn-small text-uppercase robotob py-2">Gửi yêu cầu</button>
        </div>
    </div>
</form>