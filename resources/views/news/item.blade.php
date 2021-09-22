<div class="new-medium d-flex flex-wrap py-3 py-xxl-4 wow fadeInUp">
    <div class="img">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
            @include('image_loader.big',['itemImage'=>$item])
        </a>
    </div>
    <div class="content">
        <h3>
            <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
        </h3>
        <p class="fs-16-cv my-1 my-xl-2">{{Str::words($item->short_content,'35')}}</p>
        <div class="item-time mt-1">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>{{\Support::showDate($item->time_published)}}</span>
        </div>
    </div>
</div>