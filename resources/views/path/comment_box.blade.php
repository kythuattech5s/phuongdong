<div class="comment-box__content">
    <p class="comment-box__title">Đánh giá</p>
    <div class="comment-box__percent">
        @include('path.ratingScore')
        @include('path.ratingList')
    </div>
    <p class="comment-box__title">Bình luận</p>
    <div class="comment-box__list">
        @include('path.comment')
    </div>
    @if($comments->lastPage() > $comments->currentPage())
        <button type="button" class="more-comment" page-table="{{$map_table}}" page-id="{-currentItem.id-}" page-current="{{$comments->currentPage()}}">Xem thêm</button>
    @endif
    @if (Auth::check())
        <p class="comment-box__title mt-4">Đánh giá và bình luận</p>
        <div class="comment-box__form">
            @php
                $user = Auth::user();
            @endphp
            <div class="comment-box__form-img"
                style="background-image:url('{%IMGV2.user.img.390x0%}')">
            </div>
            <form action="/binh-luan" data-clear method="POST" class="formComment formValidation" data-parent="form-validate" data-file enctype="multipart/form-data" data-success="COMMENT.receivedComment" data-check>
                @csrf
                <div class="flex">
                    <div class="form-validate">
                        @include('path.selectStar')
                    </div>
                    <ul class="gallery-preview" data-gallery>
                    </ul>
                </div>
                <input type="hidden" name="map_id" value="{-currentItem.id-}">
                <input type="hidden" name="map_table" value="{{$map_table}}">
                <div class="form-validate mb-3">
                    <textarea name="content" placeholder="Bình luận" m-required="Hãy để lại bình luận" cols="26" rules="required"></textarea>
                </div>
                <div class="formComment__action">
                    <button class="btn btn--orange" type="submit">Bình luận ngay</button>
                    <label for="formComment__file" class="formComment__label formComment__label--upload">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <span>Upload</span>
                        <input type="file" id="formComment__file" name="img" multiple input-file>
                    </label>
                </div>
            </form>
        </div>
    @endif
</div>
