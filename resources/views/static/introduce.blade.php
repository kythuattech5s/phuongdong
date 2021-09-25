@extends('index')
@section('content')
<section class="introduce-banner">
    <img src="{Iintroduce_banner.imgI}" title="{Iintroduce_banner.titleI}" alt="{Iintroduce_banner.altI}" class="img-fluid w-100">
</section>
<section class="about-us-introduce py-4 py-xl-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <p class="robotob all-title mb-2 wow fadeInUp">{[introduce_about_title]}</p>
                <div class="s-content fs-16 mt-3 mt-xl-4 wow wow fadeInLeft" data-wow-delay="0.15s">
                    {[introduce_about_content]}
                </div>
                @php
                    $aboutListContent = SettingHelper::getSetting('introduce_about_list_info');
                    $aboutListContentArr = json_decode($aboutListContent,true);
                @endphp
                <ul class="wow fadeInUp fs-16" data-wow-delay="0.3s">
                    @foreach ($aboutListContentArr as $key => $item)
                        <li class="mb-2">
                            <div class="icon d-inline-block me-2">
                                <img src="frontend/images/icon_check.png" title="" alt="" class="img-fluid smooth">
                            </div>
                            {{$item['name']}}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6 mt-3 mt-lg-0 ps-xl-5">
                <div class="image wow fadeInRight" data-wow-delay="0.3s">
                    <img src="{Iintroduce_about_img.imgI}" title="{Iintroduce_about_img.titleI}" alt="{Iintroduce_about_img.altI}" class="img-fluid w-100">
                </div>
            </div>
        </div>
        @php
            $introAboutInfo = SettingHelper::getSetting('introduce_list_info');
            $introAboutInfoArr = json_decode($introAboutInfo,true);
        @endphp
        <div class="list-content-about-us text-center robotob pb-3 mt-5 list_count_top">
            <div class="row">
                @foreach ($introAboutInfoArr as $key => $item)
                    <div class="item col-6 col-lg-3 mt-3 wow fadeInUp" data-wow-delay="{{$key*0.2}}s">
                        <div class="icon d-flex justify-content-center align-items-center mx-auto">
                            <img loading="lazy" src="{{$item['img']}}" class="img-fluid smooth">
                        </div>
                        <div class="fs-36-cv d-flex justify-content-center clmain mb-1 mt-2">
                            @php
                                $number = preg_replace('/[^0-9]/', '', $item['name']);
                            @endphp
                            <span class="item_count">{{$number}}</span>
                            <span>{{str_replace($number,'', $item['name'])}}</span>
                        </div>
                        <p class="fs-16">{{$item['content']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="vision-and-mission py-4 py-xl-5">
    <div class="container mt-4 mt-xl-5 pt-xl-3">
        <p class="robotob all-title mb-2 wow fadeInLeft">{[introduce_vct_title]}</p>
        @php
            $introVctInfo = SettingHelper::getSetting('introduce_vct_list_info');
            $introVctInfoArr = json_decode($introVctInfo,true);
        @endphp
        <div class="row gx-3 gx-lg-4">
            @foreach ($introVctInfoArr as $key => $item)
                <div class="col-sm-6 col-lg-4 mx-auto mt-3 mt-xl-4 wow flipInY" data-wow-delay="{{$key*0.15}}s">
                    <div class="item px-3 px-xl-4 pt-3 pt-xl-4 h-100">
                        <div class="h-100  position-relative">
                            <p class="fs-24 clmain robotob">{{$item['name']}}</p>
                            <div class="content mt-3 pb-3 pb-xl-4">{{$item['content']}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="geographical-advantage">
    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-6 col-xl-5 px-3 px-md-4 px-lg-5 mb-3 mb-lg-0 sp-col order-lg-2">
            <div class="d-flex align-items-center h-100">
                <div>
                    <p class="robotob all-title mb-2 wow fadeInUp">{[introduce_ga_title]}</p>
                    <div class="s-content mt-3 mt-lg-4 wow fadeInRight" data-wow-delay="0.2s">
                        {[introduce_ga_content]}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 px-0 pe-lg-4">
            <div class="img-360 position-relative wow fadeInUp">
                <div class="c-img">
                    <? /* ?>
                    <iframe src="{[introduce_ga_link]}"></iframe>
                    <? */ ?>
                </div>
                <div class="icon-360-play">
                    <img src="frontend/images/360-image.png" title="" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="green-hospital-model py-4 py-xl-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pe-lg-4 pt-lg-3">
                <p class="robotob all-title mb-2 wow fadeInUp">{[introduce_ghm_title]}</p>
                <div class="s-content mt-3 mt-lg-4 wow fadeInLeft" data-wow-delay="0.2s">
                    {[introduce_ghm_content]}
                </div>
            </div>
            <div class="col-lg-6">
                @php
                    $introGhmImgs = SettingHelper::getSetting('introduce_ghm_imgs');
                    $introGhmImgsArr = json_decode($introGhmImgs,true);
                @endphp
                <div class="position-relative wow fadeInRight" data-wow-delay="0.3s">
                    <div class="swiper-container slider-green-hospital-model">
                        <div class="swiper-wrapper">
                            @foreach ($introGhmImgsArr as $item)
                                @php
                                    $itemImage = new \stdClass;
                                    $itemImage->img = json_encode($item);
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item p-3">
                                        <div class="c-img">
                                            @include('image_loader.all')
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="slider-pagination position-static mt-1 mt-lg-3">
                        <div class="pagination-green-hospital-model"></div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</section>
<section class="introdule-doctor-list py-4 py-xl-5">
    <div class="container">
        <p class="robotob all-title mb-4 mb-xl-5 mb-2 wow fadeInUp">{[introduce_doctor_list_title]}</p>
    </div>
    <div class="list-item row gx-0">
        @php
            $introDoctorList = SettingHelper::getSetting('introduce_doctor_list');
            $introDoctorListArr = json_decode($introDoctorList,true);
        @endphp
        @foreach ($introDoctorListArr as $key => $item)
            <div class="item mx-auto col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{$key*0.25}}s">
                <div class="content p-3 p-lg-4 p-xxl-5 h-100">
                    <p class="name mb-3 robotob">{{$key < 9 ? '0'.($key+1):$key+1}}</p>
                    <div class="text">
                        {{$item['content']}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<section class="introduce-ttb">
    <div class="container pb-4 pb-xl-5">
        <div class="row align-items-center">
            <div class="col-lg-5 pe-lg-5">
                <p class="robotob all-title mb-2 wow fadeInUp">{[introduce_ttb_title]}</p>
                <div class="s-content mt-3 mt-lg-4 wow fadeInLeft" data-wow-delay="0.2s">
                    {[introduce_ttb_content]}
                </div>
            </div>
            <div class="col-lg-7">
                <div class="position-relative">
                    <div class="swiper-container slide-ttb-intrduce">
                        <div class="swiper-wrapper">
                            @foreach ($listEquipment as $itemEquipment)
                                <div class="swiper-slide h-auto p-2">
                                    <div class="item-ttb h-100">
                                        <div class="p-3">
                                            <div class="c-img zoom-effect">
                                                @include('image_loader.all',['itemImage'=>$itemEquipment])
                                            </div>
                                            <div class="short-content px-2 py-3 py-xl-4">
                                                {{$itemEquipment->short_content}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="slider-pagination position-static mt-2">
                        <div class="pagination-ttb-intrduce"></div>
                    </div>
                </div>
            </div>
        </div>
        <p class="robotob all-title mt-4 mt-xl-5 wow fadeInUp">Lịch sử hình thành</p>
    </div>
</section>
<section class="history-begin">
    <div class="thumb">
        <div class="bg-white">
            <div class="container py-4">
                <div class="position-relative">
                    <div class="swiper-container slide-history-begin-thumb wow fadeInUp" >
                        <div class="swiper-wrapper">
                            @foreach ($historyBegin as $item)
                                <div class="swiper-slide">
                                    <div class="item cspoint">
                                        <div class="content mx-auto robotob fs-16">
                                            {{$item->year}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main py-4 pb-xl-5">
        <div class="container">
            <div class="swiper-container slide-history-begin-main wow fadeInUp" data-wow-delay="0.2s">
                <div class="swiper-wrapper">
                    @foreach ($historyBegin as $item)
                        <div class="swiper-slide">
                            <div class="item">
                                <p class="fs-24-cv robotob">{{$item->name}}</p>
                                <div class="s-content px-0 col-xxl-10 mt-2">
                                    {!!$item->content!!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="introduce-service py-4 py-xl-5">
    <div class="container">
        <p class="robotob all-title mb-4 mb-xl-5 wow fadeInUp">{[introduce_service_title]}</p>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                <div class="list-introduce-service wow fadeInLeft">
                    @php
                        $introServiceList = SettingHelper::getSetting('introduce_service_content');
                        $introServiceListArr = json_decode($introServiceList,true);
                    @endphp
                    @foreach ($introServiceListArr as $key => $item)
                        <div class="item p-3" data-wow-delay="{{$key*0.25}}s">
                            <p class="name robotob fs-24-cv">{{$item['name']}}</p>
                            <div class="mt-2 mt-lg-3">
                                {{$item['content']}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-introduce wow fadeInRight" data-wow-delay="0.4s">
                    <img src="{Iintroduce_service_img.imgI}" title="{Iintroduce_service_img.titleI}" alt="{Iintroduce_service_img.altI}" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="introduce-cooperate py-4 py-xl-5" style="background-image: url('frontend/images/Rectangle 5625.png')">
    <div class="container py-xl-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                <p class="robotob all-title white mb-3 mb-xl-4 wow fadeInUp">{[introduce_cooperate_title]}</p>
                <div class="s-content text-white wow fadeInLeft" data-wow-delay="0.2s">
                    {[introduce_cooperate_content]}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-introduce wow fadeInRight" data-wow-delay="0.4s">
                    <img src="{Iintroduce_cooperate_img.imgI}" title="{Iintroduce_cooperate_img.titleI}" alt="{Iintroduce_cooperate_img.altI}" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="introduce-message py-5" style="background-image: url('frontend/images/fountain-pen-written-page 1.png')">
    <div class="container">
        <p class="robotob all-title center mb-3 mt-xl-3 mb-xl-4 wow fadeInUp">{[introduce_message_title]}</p>
        <div class="s-content fs-16 mx-auto wow fadeInUp" data-wow-delay="0.3s" style="max-width: 1000px">
            {[introduce_message_content]}
        </div>
        <div class="py-xl-5"></div>
    </div>
</section>
<section class="leadership-module py-5">
    <div class="container">
        <p class="robotob all-title center mb-3 mt-xl-3 mb-xl-4 wow fadeInUp">Ban lãnh đạo bệnh viện</p>
        <div class="row">
            @foreach ($listLeadership as $item)
                <div class="col-md-6 col-lg-4  mx-auto">
                    <div class="item-leadership">
                        <div class="img c-img">
                            @include('image_loader.big',['itemImage'=>$item])
                        </div>
                        <div class="content text-center px-3 pb-3">
                            <p class="name robotob fs-24">{{$item->name}}</p>
                            <p class="job fs-16 my-2">{{$item->job}}</p>
                            <p class="text-uppercase fs-12 robotob">Bệnh viện đa khoa Phương đông</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="certifications-module py-5">
    <div class="container">
        <p class="robotob all-title center mb-3 mt-xl-3 mb-xl-4 wow fadeInUp">Chứng nhận & giải thưởng</p>
        <div class="swiper-container slide-certifications wow fadeInUp pt-xl-3">
            <div class="swiper-wrapper">
                @foreach ($listCertification as $itemCertification)
                    <div class="swiper-slide p-1">
                        <div class="item-certifications cspoint">
                            <div class="img text-center">
                                <a href="{{$itemCertification->link}}" class="smooth" title="{{$itemCertification->name}}">
                                    @include('image_loader.small',['itemImage'=>$itemCertification])
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="slider-pagination position-static mt-3 mt-lg-4">
            <div class="pagination-certifications"></div>
        </div>
    </div>
</section>
@stop