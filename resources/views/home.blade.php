@extends('index')
@section('content')
<section class="banner-home position-relative">
    <div class="swiper-container slide-banner-home">
        <div class="swiper-wrapper">
        	@foreach ($listBanner as $itemBanner)
                <div class="swiper-slide">
                	<a href="{{$itemBanner->link}}" class="smooth" title="{{$itemBanner->name}}">
                    	<img src="{%IMGV2.itemBanner.img.-1%}" title="{%AIMGV2.itemBanner.img.title%}" alt="{%AIMGV2.itemBanner.img.alt%}">
                	</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="slider-controls">
        <button class="slide-banner-home-prev prev-btn">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
        <button class="slide-banner-home-next next-btn">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </button>
    </div>
    <div class="slider-pagination">
        <div class="pagination-banner-home"></div>
    </div>
</section>
<section class="container position-relative pb-4 pb-xxl-5">
    <div class="module-medical-examination">
        <div class="row">
            <div class="col-lg-4 d-none d-lg-block">
                <form class="form-book-medical-examination form-send-contact fs-16 wow fadeInUp" action="{{VRoute::get('bookApointment')}}" method="post" accept-charset="utf8" autocomplete="off">
                    <p class="fs-18-cv text-uppercase clmain robotob mb-2">Đặt lịch khám chữa bệnh</p>
                    <input type="text" name="fullname" placeholder="Họ và tên (*)">
                    <div class="row gx-2">
                    <div class="col-md-6">
                            <input type="text" name="phone" placeholder="Số điện thoại (*)">
                        </div>
                        <div class="col-md-6">
                            <div id="datepicker-medical" class="input-group date" data-date-format="mm-dd-yyyy">
                                <input class="form-control" name="day_book" type="text">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="list-time-pick">
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
                    <textarea name="note" rows="2" placeholder="Nhu cầu khám bệnh (không bắt buộc)"></textarea>
                    <div class="text-center pb-xl-2">
                        <button type="submit" class="btn-all btn-all-main btn-small text-uppercase robotob">
                            Đặt lịch khám
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-8">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 mb-xxl-4">
                    <p class="all-title wow fadeInUp" data-wow-delay="0.2s">Dành cho Khách hàng</p>
                    <a href="tel:{[hotline_capcuu]}" class="btn-all btn-all-main text-uppercase d-none d-lg-flex align-items-center wow fadeInUp" data-wow-delay="0.4s">
                        <span class="fs-16 me-1">Gọi cấp cứu:</span>
                        <span class="robotob fs-22-cv">{[hotline_capcuu]}</span>
                    </a>
                </div>
                <div class="list-for-customer row col-mar-8 flex-nowrap table-responsive pb-2 pb-lg-0 wow fadeInUp" data-wow-delay="0.6s">
                    @foreach ($listForcustomer as $itemForcustomer)
                        <div class="item col">
                            <a href="{{$itemForcustomer->link}}" class="item-wrapper d-block">
                                <div class="icon mx-auto">
                                    <img src="{%IMGV2.itemForcustomer.img.-1%}" title="{%AIMGV2.itemForcustomer.img.title%}" alt="{%AIMGV2.itemForcustomer.img.alt%}">
                                </div>
                                <div class="text text-uppercase mt-2">
                                    <span>{{$itemForcustomer->name}}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <a href="{[link_forcustomer]}" class="hv-icon fs-16 btn-view-all d-none d-lg-inline-block mt-3 wow fadeInUp" data-wow-delay="0.6s" title="Xem tất cả">
                    <i class="fa fa-plus-circle fs-20 me-1" aria-hidden="true"></i>
                    <span class="text-uppercase smooth">Xem tất cả</span>
                </a>
            </div>
        </div>
    </div>
    <div class="for-customer-block mx-auto">
        <div class="row">
            <div class="col-md-6 mt-0 mt-lg-3 order-md-2">
                <p class="all-title wow fadeInUp lh-13">{[title_home_system]}</p>
                <div class="content fs-16 mt-3 mt-xxl-4 wow fadeInUp" data-wow-delay="0.3s">{[content_home_system]}</div>
                <a href="{[link_home_system]}" class="hv-icon fs-16 btn-view-all d-inline-block mt-3 wow fadeInUp" data-wow-delay="0.6s" title="Xem tất cả">
                    <i class="fa fa-plus-circle fs-20 me-1" aria-hidden="true"></i>
                    <span class="text-uppercase smooth">Xem tất cả</span>
                </a>
            </div>
            <div class="col-md-6 mt-3 mt-md-0 mt-lg-3">
                <div class="img-box wow fadeInUp">
                    <a href="{[link_you_home_system]}" data-fancybox="gallery" class="smooth c-img zoom-effect img-box-show" title="">
                        <img src="{Iimg_home_system.imgI}" title="{Iimg_home_system.titleI}" alt="{Iimg_home_system.altI}" class="img-fluid">
                        <div class="icon-play-video">
                            <span>
                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="our-service py-4 py-xxl-5" style="background-image: url('{Ibg_home_service.imgI}')">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 mb-xxl-4">
            <p class="all-title wow fadeInUp">{[title_home_service]}</p>
            <a href="{{VRoute::get('dich-vu-y-te')}}" class="hv-icon fs-16 btn-view-all d-none d-md-inline-block mt-3 wow fadeInUp" data-wow-delay="0.2s" title="Dịch vụ của chúng tôi">
                <span class="text-uppercase smooth">Xem tất cả</span>
                <i class="fa fa-plus-circle fs-20 ms-1" aria-hidden="true"></i>
            </a>
        </div>
        <div class="row mb-3 mb-xxl-4 d-none d-md-flex wow fadeInUp" data-wow-delay="0.4s">
            <div class="col-lg-9">
                <div class="short-content fs-16">{[content_home_service]}</div>
            </div>
        </div>
        <div class="swiper-container slide-our-service wow fadeInUp" data-wow-delay="0.6s">
            <div class="swiper-wrapper">
                @foreach ($listService as $item)
                    <div class="swiper-slide">
                        @include('services.item_home')
                    </div>
                @endforeach
            </div>
        </div>
        <div class="slider-pagination d-none d-md-block mt-3 mt-xxl-4 wow fadeInUp" data-wow-delay="0.8s">
            <div class="pagination-our-service"></div>
        </div>
    </div>
</section>
<section class="expert-team py-4 py-xxl-5">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 mb-xxl-4">
            <p class="all-title wow fadeInUp">{[title_home_doctor]}</p>
            <a href="{{VRoute::get('doi-ngu-bac-si')}}" class="hv-icon fs-16 btn-view-all d-none d-md-inline-block mt-3 wow fadeInUp" data-wow-delay="0.2s" title="Đội ngũ bác sĩ">
                <span class="text-uppercase smooth">Tìm bác sĩ</span>
                <i class="fa fa-plus-circle fs-20 ms-1" aria-hidden="true"></i>
            </a>
        </div>
        <div class="short-content mb-3 mb-xxl-4 fs-16 wow fadeInUp" data-wow-delay="0.4s">{[content_home_doctor]}</div>
        <div class="main-slide position-relative">
            <div class="swiper-container slide-expert-team wow fadeInUp" data-wow-delay="0.6s">
                <div class="swiper-wrapper">
                    @foreach ($listDoctor as $item)
                        <div class="swiper-slide">
                            <div class="item-expert-team">
                                <div class="row">
                                    <div class="col-9 col-md-5 mx-auto">
                                        <div class="img text-center">
                                            <a href="{{$item->slug}}" title="{{$item->name}}">
                                                <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                                            </a>
                                        </div>
                                        <div class="name text-center mt-2 mt-xxl-3">
                                            <h3 class="fs-22 clmain robotob">
                                                <a href="{{$item->slug}}" class="smooth hv-sp" title="{{$item->name}}">{{$item->name}}</a>
                                            </h3>
                                            <p class="fs-16">{{$item->academic_rank}} - {{$item->position}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-7 mt-3 mt-md-0">
                                        <div class="list-info-doctor-content">
                                            <div class="item">
                                                <div class="header-item mb-2 d-flex align-items-center">
                                                    <div class="icon me-2">
                                                        <img src="frontend/images/icon_team1.png" title="" alt="" class="img-fluid smooth">
                                                    </div>
                                                    <p class="fs-22-cv clmain">Giới thiệu</p>
                                                </div>
                                                <div class="content-item fs-16">
                                                    Gần 40 năm trong nghề, TTND.TS.BS Hoàng Văn Tuyết đã tham gia vào công tác khám chữa bệnh, phòng bệnh ở các bệnh viện tuyến Trung ương như: Bệnh viện Bạch Mai; Bệnh viện Nhiệt Đới Trung ương,...
                                                </div>
                                            </div>
                                            <div class="item d-none d-md-block">
                                                <div class="header-item mb-2 d-flex align-items-center">
                                                    <div class="icon me-2">
                                                        <img src="frontend/images/icon_team2.png" title="" alt="" class="img-fluid smooth">
                                                    </div>
                                                    <p class="fs-22-cv clmain">Kink nghiệm</p>
                                                </div>
                                                <div class="content-item fs-16">Bác sĩ Hoàng Văn Tuyết là người có nhiều kinh nghiệm trong các công tác phòng chống dịch quốc gia, như: dịch cúm AH5N1 năm 2005, dịch tiêu chảy cấp năm 2007, dịch H1N1 năm 2009, dịch Ebola, ...</div>
                                            </div>
                                            <div class="item d-none d-md-block">
                                                <div class="header-item mb-2 d-flex align-items-center">
                                                    <div class="icon me-2">
                                                        <img src="frontend/images/icon_team3.png" title="" alt="" class="img-fluid smooth">
                                                    </div>
                                                    <p class="fs-22-cv clmain">Thành tựu</p>
                                                </div>
                                                <div class="content-item fs-16">Thầy thuốc nhân dân (2017), Huân chương Lao động hạng III, Bằng khen của Thủ tướng Chính phủ, Bằng khen của Bộ Y tế, Lưu niệm chương Vì sự nghiệp chăm sóc sức khỏe nhân dân ...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="slider-controls">
                <button class="slide-expert-team-prev prev-btn">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </button>
                <button class="slide-expert-team-next next-btn">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="swiper-container slide-expert-team-thumb pt-0 pt-md-2 mt-3 mt-xxl-4 wow fadeInUp" data-wow-delay="0.8s">
            <div class="swiper-wrapper">
                @foreach ($listDoctor as $item)
                    <div class="swiper-slide">
                        <div class="item-expert-team-thumb cspoint">
                            <div class="img text-center">
                                <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                            </div>
                            <div class="text text-center mt-2 pt-2">
                                <p>{{$item->academic_rank}}</p>
                                <p class="fs-18">{{$item->name}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="modern-equipment-home pt-4 pt-xxl-5 pb-lg-4 pb-xxl-5" style="background-image: url('{Ibg_home_ttb.imgI}')">
    <div class="container px-mobile">
        <div class="row">
            <div class="col-lg-4">
                <div class="all-title-wrapper">
                    <p class="all-title white wow fadeInUp">{[title_home_ttb]}</p>
                </div>
            </div>
            <div class="col-lg-8 ps-xxl-5 d-none d-lg-block wow fadeInUp" data-wow-delay="0.3s">
                <div class="short-content text-white fs-16">{[content_home_ttb]}</div>
            </div>
        </div>
    </div>
    <div class="container container-sp">
        <div class="position-relative modern-equipment-home-wraper wow fadeInUp">
            <div class="modern-equipment-home-img">
                <div class="position-relative">
                    <div class="swiper-container slide-ttb-home">
                        <div class="swiper-wrapper">
                            @foreach ($listEquipment as $itemEquipment)
                                <div class="swiper-slide">
                                    <div class="item-img-equipment">
                                        <div class="c-img zoom-effect">
                                            <img src="{%IMGV2.itemEquipment.img.-1%}" title="{%AIMGV2.itemEquipment.img.title%}" alt="{%AIMGV2.itemEquipment.img.alt%}">
                                        </div>
                                        <div class="d-block d-lg-none py-3">
                                            <p class="all-sub-title small-text">{{$itemEquipment->name}}</p>
                                            <div class="short-content fs-16 my-3">
                                                {{$itemEquipment->short_content}}
                                            </div>
                                             <a href="{[link_forcustomer]}" class="fs-16 btn-view-all-main d-inline-block" title="Xem thêm">
                                                <i class="fa fa-plus-circle fs-20 me-1" aria-hidden="true"></i>
                                                XEM THÊM
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="slider-pagination mt-3 mt-lg-4">
                        <div class="pagination-ttb-home"></div>
                    </div>
                </div>
            </div>
            <div class="modern-equipment-home-content d-none d-lg-block">
                <div class="position-relative">
                    <div class="swiper-container slide-ttb-content-home">
                        <div class="swiper-wrapper">
                            @foreach ($listEquipment as $itemEquipment)
                                <div class="swiper-slide p-1">
                                    <div class="item-content-equipment">
                                        <p class="all-sub-title small-text">{{$itemEquipment->name}}</p>
                                        <div class="short-content fs-16 my-3">
                                            {{$itemEquipment->short_content}}
                                        </div>
                                         <a href="{[link_forcustomer]}" class="fs-16 btn-view-all-main d-inline-block" title="Xem thêm">
                                            <i class="fa fa-plus-circle fs-20 me-1" aria-hidden="true"></i>
                                            XEM THÊM
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="new-home py-4 py-xxl-5">
    <div class="container">
        <p class="all-title wow fadeInUp mb-3 mb-xxl-4">Tin tức và sự kiện</p>
        @include('news.news_module',['listNews'=>$listNews])
    </div>
</section>
<section class="partner-home">
    <div class="container pb-4 pb-xxl-5">
        <div class="swiper-container slide-partner wow fadeInUp">
            <div class="swiper-wrapper">
                @foreach ($listPartner as $itemPartner)
                    <div class="swiper-slide p-1">
                        <div class="item-partner cspoint">
                            <div class="img text-center">
                                <a href="{{$itemPartner->link}}" class="smooth" title="{{$itemPartner->name}}">
                                    <img src="{%IMGV2.itemPartner.img.-1%}" title="{%AIMGV2.itemPartner.img.title%}" alt="{%AIMGV2.itemPartner.img.alt%}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="slider-pagination d-none d-lg-block mt-3">
            <div class="pagination-partner-home"></div>
        </div>
    </div>
</section>
@endsection