<div class="row gx-4 gx-xxl-5 new-module">
    <div class="big-col col wow fadeInUp">
        @foreach (array_slice($listNews,0,1) as $item)
            <div class="item-new-big">
                <div class="img">
                    <a href="{{$item->slug}}" class="c-img shine-effect" title="{{$item->name}}">
                        <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                    </a>
                </div>
                <div class="content">
                    <h3 class="mt-2">
                        <a href="{{$item->slug}}" class="smooth robotob fs-22-cv hv-main-sp" title="{{$item->name}}">{{$item->name}}</a>
                    </h3>
                    <div class="short-content fs-16 mt-1 mt-lg-2">
                        {{Str::words($item->short_content,'28')}}
                    </div>
                    <div class="item-time d-block d-lg-none mt-1">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>{{\Support::showDate($item->time_published)}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="medium-col col wow fadeInUp" data-wow-delay="0.3s">
         @foreach (array_slice($listNews,1,2) as $item)
            <div class="item-new-medium">
                <div class="img">
                    <a href="{{$item->slug}}" class="c-img shine-effect" title="{{$item->name}}">
                        <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                    </a>
                </div>
                <div class="content">
                    <h3 class="mt-2">
                        <a href="{{$item->slug}}" class="smooth robotob fs-16-cv hv-main-sp" title="{{$item->name}}">{{$item->name}}</a>
                    </h3>
                </div>
            </div>
        @endforeach
    </div>
    <div class="small-col col mt-3 mt-lg-0 wow fadeInUp" data-wow-delay="0.6s">
        @foreach (array_slice($listNews,3,4) as $item)
            <div class="item-new-small d-flex">
                <div class="img order-lg-2">
                    <a href="{{$item->slug}}" class="c-img shine-effect" title="{{$item->name}}">
                        <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                    </a>
                </div>
                <div class="content">
                    <h3>
                        <a href="{{$item->slug}}" class="smooth robotob fs-16 hv-main-sp" title="{{$item->name}}">{{$item->name}}</a>
                    </h3>
                    <div class="item-time d-block d-lg-none mt-1">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>{{\Support::showDate($item->time_published)}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-12 mt-3">
        <div class="border-bottom"></div>
    </div>
</div>