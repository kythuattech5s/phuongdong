<div class="item-doctor-same-specialty">
    <div class="img shine-effect">
        <a href="{{Support::show($itemDoctor,'slug')}}" class="smooth" title="{{$itemDoctor->name}}">
            @include('image_loader.big',['itemImage'=>$itemDoctor])
        </a>
    </div>
    <div class="content smooth text-center">
        <h3><a href="{{Support::show($itemDoctor,'slug')}}" class="smooth" title="{{$itemDoctor->name}}">{{$itemDoctor->academic_rank}} {{$itemDoctor->name}}</a></h3>
        @php
            $specialist = $itemDoctor->getSpecialist();
        @endphp
        <p><a href="doi-ngu-bac-si/{{Support::show($specialist,'slug')}}" class="smooth robotob hv-main-sp" title="{{$specialist->name}}">{{$specialist->name}}</a></p>
        <div class="info-rating d-flex justify-content-center align-items-center mb-2">
            <div class="rating-info">
                @php
                    $rating = $itemDoctor->getRating('main');
                @endphp
                @include('path.rating',['rating' => $rating['percentAll'].'%'])
            </div>
        </div>
    </div>
</div>