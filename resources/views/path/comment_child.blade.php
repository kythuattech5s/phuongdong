@foreach ($childs as $commentChild)
<div class="comment-item">
    <div class="comment-item__top">
        @php 
            $user = $commentChild->user;
        @endphp 
        <div class="comment-item__img" style="background-image:url({%IMGV2.user.img.390x0%})">
        </div>
        <div class="comment-item__info">
            <div class="comment-user__info {{$user->is_admin == 1 ? 'admin' : ''}} ">
                <strong class="user-info__name">
                    {{ $user->name ?? 'Quản trị viên' }}
                </strong>
                <span class="comment-item__datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> {-commentChild.created_at-}</span>
            </div>
            <span class="comment-item__type">Student</span>
        </div>
    </div>
    <div class="comment-item__content">
        {-commentChild.content-}
    </div>
</div>
@endforeach