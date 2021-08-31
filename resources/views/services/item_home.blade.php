<div class="item-our-service">
    <div class="img">
        <a href="{{$item->slug}}" class="smooth c-img zoom-effect img-box-show" title="{{$item->name}}">
            <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
        </a>
    </div>
    <div class="content">
        <h2><a href="{{$item->slug}}" class="smooth fs-24-cv robotob hv-sp" title="{{$item->name}}">{{$item->name}}</a></h2>
        <div class="fs-16 my-2">{{Str::words($item->short_content,'25')}}</div>
        <a href="{{$item->slug}}" class="hv-icon fs-20 btn-view-all d-inline-block" title="{{$item->name}}">
            <i class="fa fa-plus-circle fs-28 ms-1" aria-hidden="true"></i>
        </a>
    </div>
</div>