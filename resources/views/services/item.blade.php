<div class="item-cate-service-sub wow fadeInUp">
    <div class="img">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
            @include('image_loader.big',['itemImage'=>$item])
        </a>
    </div>
    <div class="content">
        <h2 class="name lh-13">
            <a href="{{Support::show($item, 'slug')}}" class="smooth fs-24-cv hv-main-sp robotob" title="{{$item->name}}">{{$item->name}}</a>
        </h2>
        <div class="short_content fs-16-cv my-1 my-lg-2">
            {{Str::words($item->short_content,'25')}}
        </div>
        <a href="{{Support::show($item, 'slug')}}" class="hv-icon btn-view-all d-inline-block" title="{{Support::show($item, 'name')}}">
            <i class="fa fa-plus-circle fs-22" aria-hidden="true"></i>
        </a>
    </div>
</div>