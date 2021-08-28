@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 shadow-box-right py-3 py-md-4 pe-lg-4">
            {{\Breadcrumbs::render('static','Chuyên khoa','chuyen-khoa')}}
            <h1 class="fs-30-cv robotob mb-1 wow fadeInUp">Bệnh tiêu hóa</h1>
            <p class="fs-16-cv wow fadeInUp">Bệnh về đường tiêu hóa là những loại bệnh xảy ra ở ở các bộ phận thuộc hệ tiêu hóa làm ảnh hưởng đến quá trình tiêu hóa thức ăn, nước uống và sức khỏe tổng thể. Một số loại bệnh về đường tiêu hóa thường gặp là rối loạn tiêu hóa, viêm loét dạ dày, viêm đại tràng, sỏi mật, trĩ, xơ gan…</p>
            <div class="new-big d-flex flex-wrap py-3 py-xxl-4 wow fadeInUp">
                <div class="img">
                    <a href="" class="smooth c-img shine-effect" title="">
                        <img src="theme/frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                    </a>
                </div>
                <div class="content">
                    <h3>
                        <a href="" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                    </h3>
                    <p class="fs-16-cv my-2 my-xl-3">Chào bác sĩ, lúc trước do đau bụng nên em có đi khám siêu âm ổ bụng thì phát hiện sỏi thận. Bác sĩ có cho em một số thuốc như Scanax 500 và Drotaverin 80, cho em hỏi thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</p>
                    <div class="item-time mt-1">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>06/09/2021</span>
                    </div>
                </div>
            </div>
            <?php for ($i = 1; $i < 10; $i++) { ?>
                <div class="new-medium d-flex flex-wrap py-3 py-xxl-4 wow fadeInUp">
                    <div class="img">
                        <a href="" class="smooth c-img shine-effect" title="">
                            <img src="theme/frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                        </a>
                    </div>
                    <div class="content">
                        <h3>
                            <a href="" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                        </h3>
                        <p class="fs-16-cv my-1 my-xl-2">Đại trực tràng là một bộ phận thuộc hệ tiêu hóa và giữ vai trò nhất định trong cơ thể con người. Tuy nhiên, nhiều người vẫn chưa hiểu rõ cấu tạo, vị trí và chức năng của...</p>
                        <div class="item-time mt-1">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>06/09/2021</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="pagenigation mb-2 mt-3 mt-xl-4">
                <strong>1</strong>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop