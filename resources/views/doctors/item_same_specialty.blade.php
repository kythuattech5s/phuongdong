<div class="item-doctor-same-specialty">
    <div class="img shine-effect">
        <a href="{{$itemDoctor->slug}}" class="smooth" title="{{$itemDoctor->name}}">
            <img src="{%IMGV2.itemDoctor.img.-1%}" title="{%AIMGV2.itemDoctor.img.title%}" alt="{%AIMGV2.itemDoctor.img.alt%}">
        </a>
    </div>
    <div class="content smooth text-center">
        <h3><a href="{{$itemDoctor->slug}}" class="smooth" title="{{$itemDoctor->name}}">{{$itemDoctor->academic_rank}} {{$itemDoctor->name}}</a></h3>
        @php
            $specialist = $itemDoctor->getSpecialist();
        @endphp
        <p><a href="doi-ngu-bac-si/{{$specialist->slug}}" class="smooth robotob hv-main-sp" title="{{$specialist->name}}">{{$specialist->name}}</a></p>
        <div class="info-rating d-flex justify-content-center align-items-center mb-2">
            <div class="rating-info">
                <img src="frontend/images/rating.png" title="" alt="" class="img-fluid smooth">
            </div>
        </div>
    </div>
</div>