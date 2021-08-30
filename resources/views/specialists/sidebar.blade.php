<div class="sidebar-all py-4 py-xxl-5">
    <p class="side-bar-title robotob wow fadeInUp">DỊCH VỤ Y TẾ</p>
    <ul class="list-service-sidebar mt-2 fs-18 wow fadeInUp">
        <li><a href="" class="smooth" title=""><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>Các gói khám tầm soát ung thư</a></li>
        <li><a href="" class="smooth" title=""><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>Gói khám sức khỏe</a></li>
        <li><a href="" class="smooth" title=""><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>Gói xét nghiệm tổng quát tại nhà</a></li>
        <li><a href="" class="smooth" title=""><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>Khám sức khỏe doanh nghiệp</a></li>
    </ul>
    <form class="form-contact-sidebar mt-3 mt-xl-4 wow fadeInUp" action="" method="post" accept-charset="utf8" autocomplete="off">
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
    <div class="service-slider wow fadeInUp mt-3 mt-xxl-4">
        <div class="header-item d-flex justify-content-between flex-wrap">
            <p class="text-uppercase fs-18 robotob me-2 clmain">Các dịch vụ nổi bật</p>
            <div class="controls">
                <button class="slide-hot-service-prev prev-btn me-2">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </button>
                <button class="slide-hot-service-next next-btn">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="swiper-container hot-service-slider">
            <div class="swiper-wrapper">
                <?php for ($i = 1; $i < 3; $i++) { ?>
                    <div class="swiper-slide">
                        <div class="item-hot-service-slider">
                            <div class="img">
                                <a href="" class="smooth c-img shine-effect" title="">
                                    <img src="frontend/images/Layer 3.png" alt="banner">
                                </a>
                            </div>
                            <div class="content mt-1">
                                <h2><a href="" class="smooth fs-16 robotob hv-main-sp" title="">Thai sản trọn gói</a></h2>
                                <div class="text-right d-flex flex-wrap justify-content-between">
                                    <div class="short-content fs-12">
                                        Ưu đãi hấp dãn
                                    </div>
                                    <a href="" class="smooth hv-icon btn-all btn-all-main d-inline-block" title="">
                                        <span class="me-1">XEM THÊM</span>
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>