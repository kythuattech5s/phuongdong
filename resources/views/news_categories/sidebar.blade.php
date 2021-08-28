<div class="sidebar-all py-4 py-xxl-5">
    <p class="side-bar-title robotob wow fadeInUp">BÀI VIẾT MỚI</p>
    <div class="new-side-bar-big py-3 wow fadeInUp" data-wow-delay="0.2s">
        <div class="img">
            <a href="" class="smooth c-img shine-effect" title="">
                <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
            </a>
        </div>
        <div class="content mt-2 mt-xl-3">
            <h3>
                <a href="" class="smooth hv-main-sp fs-18-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
            </h3>
            <div class="item-time mt-1">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>06/09/2021</span>
            </div>
            <p class="fs-16-cv mt-2 mt-xl-2">Không có gì tồi tệ hơn là bị đau răng khôn khi bạn đang mang thai. Bạn không thể tự uống các loại thuốc giảm đau hay có thể nhổ ngay lập tức...</p>
        </div>
    </div>
    <?php for ($i = 1; $i < 5; $i++) { ?>
        <div class="new-side-bar-small d-flex py-3 wow fadeInUp" data-wow-delay="<?= 0.2+$i*0.1 ?>s">
            <div class="img">
                <a href="" class="smooth c-img shine-effect" title="">
                    <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                </a>
            </div>
            <div class="content ps-3">
                <h3>
                    <a href="" class="smooth hv-main-sp fs-18-cv robotob lh-13" title="">Cẩm nang dành cho mẹ bầu trước khi mang thai</a>
                </h3>
                <div class="item-time mt-1">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>06/09/2021</span>
                </div>
            </div>
        </div>
    <?php } ?>
    <form class="form-contact-sidebar mt-4 mt-xl-5 wow fadeInUp" action="" method="post" accept-charset="utf8" autocomplete="off">
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