<div class="item-gallery">
	<div class="img position-relative">
        <a href="{{$item->slug}}" class="smooth c-img shine-effect" title="{{$item->name}}">
            <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
        </a>
        <div class="icon big">
        	<i class="fa fa-caret-right" aria-hidden="true"></i>
        </div>
    </div>
    <div class="content mt-2">
        <h3>
            <a href="{{$item->slug}}" class="smooth hv-main-sp fs-16 robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
            <span class="sp-time">({{\Support::showDate($item->created_at)}})</span>
        </h3>
    </div>
</div>