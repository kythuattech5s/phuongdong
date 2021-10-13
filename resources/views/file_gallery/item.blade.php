<div class="item-gallery">
	<div class="img position-relative">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img c-img-file shine-effect" title="{{$item->name}}">
            @if ($item->img != '')
                @include('image_loader.big',['itemImage'=>$item])
            @else
                @php
                    $fileInfo = json_decode($item->file,true);
                @endphp
                @if (isset($fileInfo['name']))
                    <img src="frontend/images/{{pathinfo($fileInfo['name'])['extension']}}.png" title="" alt="" class="img-fluid">
                @endif
            @endif
        </a>
        <div class="icon">
        	<i class="fa fa-file" aria-hidden="true"></i>
        </div>
    </div>
    <div class="content mt-2">
        <h3>
            <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-16 robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
            <span class="sp-time">({{\Support::showDate($item->created_at)}})</span>
        </h3>
    </div>
</div>