@extends('index')
@section('content')
<section class="container">
    {{\Breadcrumbs::render('doctors',$currentItem,$specialists)}}
    <div class="border-top mt-2">
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-28">
            <div class="px-lg-3">
                <div class="sidebar-all py-4">
                    <div class="item-doctor-siderbar wow fadeInUp">
                        <div class="border">
                            <div class="img px- shine-effect">
                                <img src="{%IMGV2.currentItem.img.-1%}" title="{%AIMGV2.currentItem.img.title%}" alt="{%AIMGV2.currentItem.img.alt%}">
                            </div>
                            <div class="content text-uppercase fs-12 text-center">
                                {{$currentItem->academic_rank}}: <span class="robotob">{{$currentItem->name}}</span>
                            </div>
                        </div>
                        <div class="rating-info text-center my-3">
                            <img src="frontend/images/rating.png" title="" alt="" class="img-fluid smooth">
                        </div>
                    </div>
                    <form class="form-contact-sidebar mt-3 mt-xl-4 wow fadeInUp" action="" method="post" accept-charset="utf8" autocomplete="off">
                        <div class="header-form text-center py-2 py-lg-3">
                            <p class="fs-16 px-3 mb-1">Đặt lịch hẹn với: {{$currentItem->academic_rank}} </p>
                            <p class="fs-18 text-uppercase robotob">{{$currentItem->name}}</p>
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
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-72 shadow-box-left py-3 py-md-4 ps-lg-5">
            <p class="fs-16 wow fadeInUp">{{$currentItem->academic_rank}}</p>
            <h1 class="text-uppercase fs-26-cv robotob clmain wow fadeInUp">{{$currentItem->name}}</h1>
            <p class="doctor-position text-uppercase wow fadeInUp">{{$currentItem->position}}</p>
            <div class="list-info-doctor-content mt-4">
                <div class="item wow fadeInUp">
                    <div class="header-item mb-2 d-flex align-items-center">
                        <p class="fs-22-cv clmain robotob">Giới thiệu</p>
                    </div>
                    <div class="content-item fs-16">
                        Gần 40 năm trong nghề, TTND.TS.BS Hoàng Văn Tuyết đã tham gia vào công tác khám chữa bệnh, phòng bệnh ở các bệnh viện tuyến Trung ương như: Bệnh viện Bạch Mai; Bệnh viện Nhiệt Đới Trung ương,...
                    </div>
                </div>
                <div class="item wow fadeInUp">
                    <div class="header-item mb-2 d-flex align-items-center">
                        <p class="fs-22-cv clmain robotob">Kink nghiệm</p>
                    </div>
                    <div class="content-item fs-16">Bác sĩ Hoàng Văn Tuyết là người có nhiều kinh nghiệm trong các công tác phòng chống dịch quốc gia, như: dịch cúm AH5N1 năm 2005, dịch tiêu chảy cấp năm 2007, dịch H1N1 năm 2009, dịch Ebola, ...</div>
                </div>
                <div class="item wow fadeInUp">
                    <div class="header-item mb-2 d-flex align-items-center">
                        <p class="fs-22-cv clmain robotob">Thành tựu</p>
                    </div>
                    <div class="content-item fs-16">Thầy thuốc nhân dân (2017), Huân chương Lao động hạng III, Bằng khen của Thủ tướng Chính phủ, Bằng khen của Bộ Y tế, Lưu niệm chương Vì sự nghiệp chăm sóc sức khỏe nhân dân ...</div>
                </div>
            </div>
            <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Hình ảnh hoạt động của {{$currentItem->academic_rank}} {{$currentItem->name}}</p>
            <div class="doctor-image position-relative wow fadeInUp">
                <div class="swiper-container slide-doctor-image">
                    <div class="swiper-wrapper">
                        @php
                            $imgs = json_decode($currentItem->imgs, true);
                            $imgs = $imgs !== null ? $imgs : [json_decode($currentItem->img,true)];
                        @endphp
                        @foreach ($imgs as $img)
                            @php
                                $itemImg = new \Stdclass;
                                $itemImg->img = json_encode($img);
                            @endphp
                            <div class="swiper-slide">
                                <div class="item-doctor-image">
                                    <div class="img">
                                        <a href="{%IMGV2.itemImg.img.-1%}" data-fancybox="gallery" class="smooth" title="">
                                            <img src="{%IMGV2.itemImg.img.-1%}" title="{%AIMGV2.itemImg.img.title%}" alt="{%AIMGV2.itemImg.img.alt%}">
                                        </a>
                                    </div>
                                    <div class="content smooth text-center p-3">
                                        <p class="fs-18">{%AIMGV2.itemImg.img.alt%}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slide-doctor-image-prev prev-btn">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <button class="slide-doctor-image-next next-btn">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <p class="all-sub-title small-text long wow fadeInUp pt-xl-2 mt-4 mb-3 text-uppercase">Các bài viết tham vấn</p>
            <div class="bottom-new-detail wow fadeInUp">
                <div class="main-wraper d-flex flex-wrap">
                    <div class="img">
                        <a href="" class="smooth c-img shine-effect" title="">
                            <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                        </a>
                    </div>
                    <div class="content">
                        <h3>
                            <a href="" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                        </h3>
                        <p class="fs-16-cv my-1 my-xl-2">Đại trực tràng là một bộ phận thuộc hệ tiêu hóa và giữ vai trò nhất định trong cơ thể con người. Tuy nhiên, nhiều người vẫn chưa hiểu rõ cấu tạo, vị trí và chức năng của...</p>
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="item-time mt-1 me-3">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>06/09/2021</span>
                            </div>
                            <div class="new-cate-info mt-1">
                                <a href="" class="smooth" title="">SẢN PHỤ KHOA</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-subitem w-100">
                    <li><a href="" class="fs-20-cv">Khám thai lần đầu khi nào và những lưu ý quan trọng</a></li>
                </ul>
            </div>
            <p class="all-sub-title small-text long wow fadeInUp mt-4 mb-3 text-uppercase">Bác sĩ cùng chuyên khoa</p>
            <div class="doctor-same-specialty position-relative wow fadeInUp">
                <div class="swiper-container slide-doctor-same-specialty">
                    <div class="swiper-wrapper">
                        @foreach ($listRelateDoctor as $itemDoctor)
                            <div class="swiper-slide">
                                @include('doctors.item_same_specialty')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="slide-doctor-same-specialty-prev prev-btn">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <button class="slide-doctor-same-specialty-next next-btn">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="slider-pagination mt-3 mt-xxl-4">
                    <div class="pagination-doctor-same-specialty"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop