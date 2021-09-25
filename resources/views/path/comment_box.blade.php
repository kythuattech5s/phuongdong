<div class="comment-box__content">
    <div class="comment-box__form">
        <form action="binh-luan" method="POST" data-clear class="formValidation overflow-hidden" data-parent=".form-group" data-success="COMMENT.receivedComment">
            @csrf
            <input type="hidden" value="{{$map_table}}" name="map_table">
            <input type="hidden" value="{{ Support::show($currentItem,'id') }}" name="map_id">
            <div class="form-group">
                <textarea id="comment" class="form-control" name="content" rules="required" m-required="Vui lòng để lại bình luận" rows="5" onchange="console.log(this.value)" placeholder="Trở thành người đầu tiên bình luận cho bài viết này"></textarea>
            </div>
            <button type="submit" class="btn-all btn-all-main mt-2 float-end"> Bình luận</button>
        </form>
    </div>
    <p class="comment-box__title">Bình luận</p>
    <div class="comment-box__list">
        @include('path.comment')
    </div>
    @if($comments->lastPage() > $comments->currentPage())
        <button type="button" class="more-comment" page-table="{{$map_table}}" page-id="{-currentItem.id-}" page-current="{{$comments->currentPage()}}">Xem thêm</button>
    @endif
    
</div>
