<div class="sidebar-all py-4 py-xxl-5">
    <p class="side-bar-title robotob wow fadeInUp">BÀI VIẾT MỚI</p>
    @php
        $listNews = \App\Models\News::act()->publish()->orderBy('time_published','desc')->take(5)->get()->all();;
    @endphp
    @foreach (array_slice($listNews,0,1) as $item)
        <div class="new-side-bar-big py-3 wow fadeInUp" data-wow-delay="0.2s">
            <div class="img">
                <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                    @include('image_loader.big',['itemImage'=>$item])
                </a>
            </div>
            <div class="content mt-2 mt-xl-3">
                <h3>
                    <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-18-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                </h3>
                <div class="item-time mt-1">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>{{Support::showDate($item->time_published)}}</span>
                </div>
                <p class="fs-16-cv mt-2 mt-xl-2">{{Str::words($item->short_content,'30')}}</p>
            </div>
        </div>
    @endforeach
    @foreach (array_slice($listNews,1,4) as $item)
        <div class="new-side-bar-small d-flex py-3 wow fadeInUp" data-wow-delay="0.3s">
            <div class="img">
                <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                    @include('image_loader.small',['itemImage'=>$item])
                </a>
            </div>
            <div class="content ps-3">
                <h3>
                    <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-18-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                </h3>
                <div class="item-time mt-1">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>{{Support::showDate($item->time_published)}}</span>
                </div>
            </div>
        </div>
    @endforeach
    @include('register_advise_form')
    @include('banner_gdn_sidebar')
</div>