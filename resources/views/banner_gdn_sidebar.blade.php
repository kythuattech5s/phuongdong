@php
    $listGdnItem = \App\Models\BannerGdn::where('group',1)->act()->get()->all();;
@endphp
@foreach ($listGdnItem as $item)
    @foreach ($listGdnItem as $item)
        <div class="sale-item-side-bar wow fadeInUp mt-4 mt-lg-5">
            @if ($item->use_code == 1)
                {!!$item->banner_content!!}
            @else
                <a href="{{$item->link}}" class="smooth" title="{{$item->name}}">
                   <img src="{%IMGV2.item.img.-1%}" title="{%AIMGV2.item.img.title%}" alt="{%AIMGV2.item.img.alt%}">
                </a>
            @endif
        </div>
    @endforeach
@endforeach