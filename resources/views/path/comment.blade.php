@forelse($comments as $comment)
    <div class="comment-item">
        <div class="comment-item__top">
            {{-- 
                @php 
                    $user = $comment->user;
                @endphp 
            --}}
            <div class="comment-item__img" style="background-image:url({IAVATAR_DEFAULT.imgI})">
            </div>
            <div class="comment-item__info">
                <div class="comment-user__info {{$comment->is_admin == 1 ? 'admin' : ''}}">
                    <strong class="user-info__name">
                        Khách hàng
                    </strong>
                    <span class="comment-item__datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ Support::showTime($comment) }}</span>
                </div>
                {{-- @if($comment->rating !== null)
                    @include('comment.rating',['rating'=>$comment->rating->rating * 20 . '%'])
                @endif --}}
            </div>
            
        </div>
        <div class="comment-item__content">
            {{Support::show($comment,'content')}}
        </div>
        {{-- <div class="comment-item__imgs">
            @php
                $imgs = json_decode($comment->imgs,true);
            @endphp
            @if($imgs !== null && count($imgs) > 0)
                @foreach($imgs as $item)
                @php
                    $img = json_decode($item['extra'],true);
                @endphp
                <div class="comment-img__item">
                    <img src="{{$img['path']}}" alt="{%AIMGV2.img.img.alt%}" title="{%AIMGV2.img.img.title%}">
                </div>
                @endforeach
            @endif
        </div> --}}
        <div class="comment-action">
            {{-- @php
                $user_like = $comment->likes->filter(function($q){
                    return $q->user->id == Auth::id();
                });
            @endphp --}}
            {{-- <button class="btn-like-comment {{$user_like->count() > 0 ? 'like' : ''}}" data-id="{-comment.id-}">@include('comment.icon.like') Like (<span>{{$comment->likes->count()}}</span>)</button> --}}
            <div class="rep-comment" action="/reply-comment" method="POST">
                @csrf
                <input type="hidden" name="parent" value="{-comment.id-}">
                <input type="hidden" name="map_table" value="{-comment.map_table-}">
                <input type="hidden" name="map_id" value="{-comment.map_id-}">
                <div class="group-form"></div>
                <button type="button" data-placeholder="Trả lời bình luận">Trả lời</button>
            </div>
        </div>
        @php
            $childs = $comment->childs;
        @endphp
        @if($childs->count() > 0)
            <div class="comment-childs">
                @include('path.comment_child')
            </div>
            {{-- @if($childs->lastPage() > $childs->currentPage())
                <button type="button" class="more-comment--child" page-current="{{$childs->currentPage()}}">Xem thêm</button>
            @endif --}}
        @endif
    </div>
@empty 
    <div class="no-result">
        Không có bình luận nào
    </div>
@endforelse