<div class="sidebar-all py-4 py-xxl-5">
    <p class="side-bar-title robotob wow fadeInUp">DỊCH VỤ Y TẾ</p>
    <ul class="list-service-sidebar mt-2 fs-18 wow fadeInUp">
        @php
            $listServiceCategory = \App\Models\ServiceCategory::where('parent',0)->act()->get();
        @endphp
        @foreach ($listServiceCategory as $item)
            <li><a href="{{$item->slug}}" class="smooth" title="{{$item->name}}"><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>{{$item->name}}</a></li>
        @endforeach
    </ul>
    @include('register_advise_form')
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
                @php
                    $listServiceHot = \App\Models\Services::where('hot',1)->act()->get();
                @endphp
                @foreach ($listServiceHot as $item)
                    <div class="swiper-slide">
                        <div class="item-hot-service-slider">
                            <div class="img">
                                <a href="{{$item->slug}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                                    <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                                </a>
                            </div>
                            <div class="content mt-1">
                                <h2><a href="{{$item->slug}}" class="smooth fs-16 robotob hv-main-sp" title="{{$item->name}}">{{$item->name}}</a></h2>
                                <div class="text-right d-flex flex-wrap justify-content-between">
                                    <div class="short-content fs-12">{{Str::words($item->short_content,'4')}}</div>
                                    <a href="{{$item->slug}}" class="smooth hv-icon btn-all btn-all-main d-inline-block" title="Xem thêm">
                                        <span class="me-1">XEM THÊM</span>
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>