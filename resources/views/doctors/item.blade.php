<div class="item-doctor d-flex flex-wrap justify-content-between align-items-center wow fadeInUp">
    <div class="content-img">
        <div class="img shine-effect">
            <a href="{{Support::show($itemDoctor, 'slug')}}" class="smooth" title="{{$itemDoctor->name}}">
                @include('image_loader.big',['itemImage'=>$itemDoctor])
            </a>
        </div>
    </div>
    <div class="info-doctor fs-16">
        <p>{{$itemDoctor->academic_rank}}</p>
        <h3 class="my-1"><a href="{{Support::show($itemDoctor,'slug')}}" class="smooth hv-main text-uppercase robotob" title="{{$itemDoctor->name}}">{{$itemDoctor->name}}</a></h3>
        @php
            $specialist = $itemDoctor->getSpecialist();
        @endphp
        @if (isset($specialist))
            <div class="mb-1">
                <span class="me-1">Chuyên khoa:</span>
                <a href="doi-ngu-bac-si/{{Support::show($specialist, 'slug')}}" class="smooth robotob hv-main-sp" title="{{$specialist->name}}">{{$specialist->name}}</a>
            </div>
        @endif
        <div class="rating-info">
            @php
                $rating = $itemDoctor->getRating('main');
            @endphp
            @include('path.rating',['rating' => $rating['percentAll'].'%'])
            <p class="fs-12">{{$rating['scoreAll']}} / 5 ( {{$rating['totalRating']}} bình chọn)</p>
        </div>
    </div>
    <div class="content">
        <div class="short-content mb-2 mb-lg-3">
            {{Str::words($itemDoctor->short_content,'35')}}
        </div>
        <a href="{{Support::show($itemDoctor, 'slug')}}" class="smooth d-inline-block hv-main" title="{{$itemDoctor->name}}">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
    </div>
</div>