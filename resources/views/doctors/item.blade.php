<div class="item-doctor d-flex flex-wrap justify-content-between align-items-center wow fadeInUp">
    <div class="content-img">
        <div class="img shine-effect">
            <a href="{{$itemDoctor->slug}}" class="smooth" title="{{$itemDoctor->name}}">
                <img src="{%IMGV2.itemDoctor.img.-1%}" title="{%AIMGV2.itemDoctor.img.title%}" alt="{%AIMGV2.itemDoctor.img.alt%}">
            </a>
        </div>
    </div>
    <div class="info-doctor fs-16">
        <p>{{$itemDoctor->academic_rank}}</p>
        <h3 class="my-1"><a href="{{$itemDoctor->slug}}" class="smooth hv-main text-uppercase robotob" title="{{$itemDoctor->name}}">{{$itemDoctor->name}}</a></h3>
        @php
            $specialist = $itemDoctor->getSpecialist();
        @endphp
        @if (isset($specialist))
            <div class="mb-1">
                <span class="me-1">Chuyên khoa:</span>
                <a href="doi-ngu-bac-si/{{$specialist->slug}}" class="smooth robotob hv-main-sp" title="{{$specialist->name}}">{{$specialist->name}}</a>
            </div>
        @endif
        <div class="rating-info">
            <img src="frontend/images/rating.png" title="" alt="" class="img-fluid smooth">
        </div>
    </div>
    <div class="content">
        <div class="short-content mb-2 mb-lg-3">
            {{Str::words($itemDoctor->short_content,'35')}}
        </div>
        <a href="{{$itemDoctor->slug}}" class="smooth d-inline-block hv-main" title="{{$itemDoctor->name}}">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
    </div>
</div>