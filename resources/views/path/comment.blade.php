@forelse($comments as $comment)
    <div class="comment-item">
        <div class="comment-item__top">
            @php 
                $user = $comment->user;
            @endphp 
            <div class="comment-item__img" style="background-image:url({%IMGV2.user.img.390x0%})">
            </div>
            <div class="comment-item__info">
                <div class="comment-user__info">
                    <strong class="user-info__name">
                        {{ $user->name }}
                    </strong>
                <span class="comment-item__datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> {-comment.created_at-}</span>
                </div>
                <span class="comment-item__type">Student</span>
                @if($comment->rating !== null)
                    @include('path.raitngPercen',['rating'=>$comment->rating->rating * 20 . '%'])
                @endif
            </div>
        </div>
        <div class="comment-item__content">
            {-comment.content-}
        </div>
        <div class="comment-item__imgs">
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
        </div>
        <div class="rep-comment" action="/tra-loi-binh-luan" method="POST">
            @csrf
            <input type="hidden" name="parent" value="{-comment.id-}">
            <input type="hidden" name="map_table" value="{-comment.map_table-}">
            <input type="hidden" name="map_id" value="{-comment.map_id-}">
            <div class="group-form"></div>
            <button type="button" data-placeholder="Trả lời bình luận">Trả lời</button>
        </div>
        @if(($childs = $comment->childs()->where('act', 1)->paginate(5))->count() > 0)
            <div class="comment-childs">
                @include('path.comment_child')
            </div>
            @if($childs->lastPage() > $childs->currentPage())
                <button type="button" class="more-comment--child" page-current="{{$childs->currentPage()}}">Xem thêm</button>
            @endif
        @endif
    </div>
@empty 
    <div class="no-result">
        Không có bình luận nào
    </div>
@endforelse