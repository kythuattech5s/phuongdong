<div class="sidebar-all">
    <div class="box-sidebar wow fadeInUp">
        <p class="all-sub-title medium text-uppercase clmain">CÂU HỎI THEO CHỦ ĐỀ</p>
        <ul class="list-service-sidebar mt-2 fs-18">
            @php
                $listCate = \App\Models\QuestionCategory::act()->get();
            @endphp
            @foreach ($listCate as $item)
                <li><a href="{{$item->slug}}" class="smooth" title="{{$item->name}}"><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>{{$item->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="box-sidebar wow fadeInUp mt-4 pb-0">
        <p class="all-sub-title medium text-uppercase clmain mb-3 mb-4">Câu hỏi mới nhất</p>
        <ul class="list-question mt-2 fs-16">
            @php
                $listQuestion = \App\Models\Question::act()->orderBy('time_ask','desc')->take(5)->get();
            @endphp
            @foreach ($listQuestion as $key => $item)
                <li class="d-flex align-items-center">
                    <div class="number">
                        {{$key+1}}
                    </div>
                    <a href="{{$item->slug}}" class="smooth link" title="{{$item->name}}">{{$item->name}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>