<div class="item-hot-galley d-flex flex-wrap align-items-end">
    <div class="img position-relative">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
            @include('image_loader.big',['itemImage'=>$item])
        </a>
        <div class="icon">
            <i class="fa fa-camera" aria-hidden="true"></i>
        </div>
    </div>
    <div class="content">
        <p class="all-sub-title">Ảnh nổi bật</p>
        <div class="content-wrapper">
            <h3 class="mb-2 mb-xl-3"><a href="{{Support::show($item, 'slug')}}" class="smooth robotob hv-sp fs-21-cv" title="{{$item->name}}">{{$item->name}}</a></h3>
            <div class="fs-16">{{Str::words($item->short_content,'50')}}</div>
        </div>
    </div>
</div>