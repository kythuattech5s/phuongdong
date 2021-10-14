@foreach ($childs as $commentChild)
<div class="comment-item">
    <div class="comment-item__top">
        <div class="comment-item__img" style="background-image:url({IAVATAR_DEFAULT.imgI})">
        </div>
        <div class="comment-item__info">
            <div class="comment-bg">
                <div class="comment-user__info"> 
                    <strong class="user-info__name">
                        {{ $commentChild->name ?? 'Không xác định' }}
                    </strong>
                    <span class="comment-item__datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ Support::showTime($commentChild) }}</span>
                </div>
                <div class="comment-item__content">
                    {-commentChild.content-}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach