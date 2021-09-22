<div class="item-gallery">
	<div class="img position-relative">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
            @include('image_loader.big',['itemImage'=>$item])
        </a>
        <div class="icon big">
        	<i class="fa fa-caret-right" aria-hidden="true"></i>
        </div>
    </div>
    <div class="content mt-2">
        <h3>
            <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-16 robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
            <span class="sp-time">({{\Support::showDate($item->created_at)}})</span>
        </h3>
    </div>
</div>