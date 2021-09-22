<div class="item-our-service">
    <div class="img">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img zoom-effect img-box-show" title="{{$item->name}}">
            @include('image_loader.big',['itemImage'=>$item])
        </a>
    </div>
    <div class="content">
        <h2><a href="{{Support::show($item, 'slug')}}" class="smooth fs-24-cv robotob hv-sp" title="{{$item->name}}">{{$item->name}}</a></h2>
        <div class="fs-16 my-2">{{Str::words($item->short_content,'25')}}</div>
        <a href="{{Support::show($item, 'slug')}}" class="hv-icon fs-20 btn-view-all d-inline-block" title="{{$item->name}}">
            <i class="fa fa-plus-circle fs-28 ms-1" aria-hidden="true"></i>
        </a>
    </div>
</div>