@php
    $listGdnItem = \App\Models\BannerGdn::where('group',1)->act()->where('time_show','>',new \DateTime())->where('time_public','<',new \DateTime())->get()->all();
@endphp
@foreach ($listGdnItem as $item)
    @foreach ($listGdnItem as $item)
        <div class="sale-item-side-bar wow fadeInUp mt-4 mt-lg-5">
            @if ($item->use_code == 1)
                {!!$item->banner_content!!}
            @else
                <a href="{{$item->link}}" {{Support::showNofollow($item)}} class="smooth" title="{{$item->name}}">
                   @include('image_loader.all',['itemImage'=>$item])
                </a>
            @endif
        </div>
    @endforeach
@endforeach