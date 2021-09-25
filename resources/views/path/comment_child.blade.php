@foreach ($childs as $commentChild)
<div class="comment-item">
    <div class="comment-item__top">
        {{-- @php 
            $user = $commentChild->user;
        @endphp --}}
        <div class="comment-item__img" style="background-image:url({IAVATAR_DEFAULT.imgI})">
        </div>
        <div class="comment-item__info">
            <div class="comment-user__info {{-- {{$user->is_admin == 1 ? 'admin' : ''}} --}} "> 
                <strong class="user-info__name">
                    {{ $commentChild->is_admin ? 'Bác sĩ' : 'Khách hàng' }}
                </strong>
                <span class="comment-item__datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ Support::showTime($commentChild) }}</span>
            </div>
        </div>
    </div>
    <div class="comment-item__content">
        {-commentChild.content-}
    </div>
</div>
@endforeach