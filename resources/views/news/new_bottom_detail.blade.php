<div class="bottom-new-detail wow fadeInUp">
    @foreach (array_slice($listNews,0,1) as $item)
        <div class="main-wraper d-flex flex-wrap">
            <div class="img">
                <a href="{{Support::show($item, 'slug')}}" class="smooth c-img shine-effect" title="{{$item->name}}">
                    @include('image_loader.big',['itemImage'=>$item])
                </a>
            </div>
            <div class="content">
                <h3>
                    <a href="{{Support::show($item, 'slug')}}" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="{{$item->name}}">{{$item->name}}</a>
                </h3>
                <p class="fs-16-cv my-1 my-xl-2">{{Str::words($item->short_content,'35')}}</p>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="item-time mt-1 me-3">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>{{\Support::showDate($item->time_published)}}</span>
                    </div>
                    @php
                        $parent = $item->category()->act()->orderBy('id','desc')->first();
                    @endphp
                    @if (isset($parent))
                        <div class="new-cate-info mt-1">
                            <a href="{{Support::show($parent, 'slug')}}" class="smooth text-uppercase" title="{{$parent->name}}">{{$parent->name}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <ul class="list-subitem w-100">
        @foreach ($listNews as $key => $item)
            @if ($key > 0)
                <li><a href="{{Support::show($item, 'slug')}}" class="fs-20-cv" title="{{$item->name}}">{{$item->name}}</a></li>
            @endif
        @endforeach
    </ul>
</div>