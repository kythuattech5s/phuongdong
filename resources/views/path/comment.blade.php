@forelse($comments as $comment)
    <div class="comment-item">
        <div class="comment-item__top">
            <div class="comment-item__img" style="background-image:url({IAVATAR_DEFAULT.imgI})">
            </div>
            <div class="comment-item__info">
                <div class="comment-bg">
                    <div class="comment-user__info {{ $comment->is_admin == 1 ? 'admin' : '' }}">
                        <strong class="user-info__name">
                            {{$comment->name ?? 'Khách hàng'}}
                        </strong>
                    </div>
                    <div class="comment-item__content">
                        {!! Support::show($comment, 'content') !!}
                    </div>
                </div>
                <div class="comment-action">
                    <div class="rep-comment" action="/reply-comment/" method="POST">
                        @csrf
                        <input type="hidden" name="parent" value="{-comment.id-}">
                        <input type="hidden" name="map_table" value="{-comment.map_table-}">
                        <input type="hidden" name="map_id" value="{-comment.map_id-}">
                        <div class="group-form"></div>
                        <button type="button" data-placeholder="Trả lời bình luận">Trả lời</button>
                        <span class="comment-item__datetime"><i class="fa fa-clock-o" aria-hidden="true"></i>
                        {{ Support::showTime($comment) }}</span>
                    </div>
                </div>
            </div>
        </div>
        @php
            $childs = $comment->childs;
        @endphp
        @if ($childs->count() > 0)
            <div class="comment-childs">
                @include('path.comment_child')
            </div>
        @endif
    </div>
@empty
    <div class="no-result">
        Không có bình luận nào
    </div>
@endforelse
