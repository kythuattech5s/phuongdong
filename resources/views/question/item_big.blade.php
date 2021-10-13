<div class="question-big d-flex flex-wrap pb-3 pb-xxl-4 mt-2 pt-1 wow fadeInUp">
    <div class="img">
        <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
            @include('image_loader.big',['itemImage'=>$item])
        </a>
    </div>
    <div class="content">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-1 mb-md-2">
            <div class="info-user-question d-flex align-items-center mb-1">
                <div class="icon fs-18 me-1">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
                <span class="fs-16 robotob">{{$item->customer_name}}</span>
            </div>
            <div class="time fs-15 mb-1">
                Đã hỏi: Ngày {{\Support::showDate($item->time_ask)}}
            </div>
        </div>
        @php
            $parent = $item->category()->act()->first();
        @endphp
        @if (isset($parent))
            <h2><a href="{{Support::show($parent, 'slug')}}" class="smooth theme-question-name text-uppercase" title="{{$parent->name}}">{{$parent->name}}</a></h2>
        @endif
        <h3>
            <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
        </h3>
        <div class="fs-16-cv my-2 my-xl-3">{{Str::words($item->question,'35')}}</div>
    </div>
</div>