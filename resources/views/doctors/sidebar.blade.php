<div class="sidebar-all py-4">
    <form class="form-search-doctor mt-xl-2 mb-4 fs-16 position-relative wow fadeInUp">
        <input type="text" name="q" placeholder="Tìm bác sĩ">
        <button type="submit" class="smooth"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
    <p class="all-sub-title wow fadeInUp mb-3">Bác sĩ chuyên khoa</p>
    <ul class="list-service-sidebar mt-2 fs-18 wow fadeInUp">
        @foreach ($listSpecialist as $item)
            <li><a href="doi-ngu-bac-si/{{$item->slug}}" class="smooth" title="{{$item->name}}"><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>{{$item->name}}</a></li>
        @endforeach
    </ul>
    <form class="form-contact-sidebar mt-2 mt-xl-3 wow fadeInUp" action="" method="post" accept-charset="utf8" autocomplete="off">
        <div class="header-form text-center py-2 lh-13">
            <p class="fs-22 text-uppercase robotob">Đăng ký tư vấn</p>
            <p class="fs-16 px-3">Đặt hẹn ngay để nhận tư vấn và xếp lịch khám kịp thời</p>
        </div>
        <div class="form-content p-3 pt-xl-4">
            <input type="text" name="fullname" placeholder="Họ và tên (*)">
            <input type="text" name="phome" placeholder="Số điện thoại (*)">
            <input type="email" name="email" placeholder="Email (*)">
            <textarea name="note" rows="2" placeholder="Nội dung"></textarea>
            <div class="text-center">
                <button class="btn-all btn-all-main btn-small text-uppercase robotob py-2">Gửi yêu cầu</button>
            </div>
        </div>
    </form>
    <div class="sale-item-side-bar wow fadeInUp mt-4 mt-lg-5">
        <a href="" class="smooth" title="">
            <img src="frontend/images/sale_sidebar.png" title="" alt="" class="img-fluid smooth">
        </a>
    </div>
</div>