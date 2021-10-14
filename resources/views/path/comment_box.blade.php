<div class="comment-box__content">
    <div class="comment-box__form">
        <form action="binh-luan/" method="POST" clear class="formValidation overflow-hidden" parent=".form-group" data-success="COMMENT.receivedComment" absolute>
            @csrf
            <input type="hidden" value="{{ $map_table }}" name="map_table">
            <input type="hidden" value="{{ Support::show($currentItem, 'id') }}" name="map_id">
            <div class="form-group">
                <textarea id="comment" class="form-control" name="content" rules="required"
                    m-required="Vui lòng để lại bình luận" rows="5" onchange="console.log(this.value)"
                    placeholder="Bình luận bài viết"></textarea>
            </div>
            <div class="d-flex mt-2 gap-2">
                <div class="form-group" style="flex:1">
                    <input type="text" class="w-100 p-2" name="name" rules="required||string"
                        placeholder="Họ và tên">
                </div>
                <div class="form-group" style="flex:1">
                    <input type="text" class="w-100 p-2" name="phone" rules="required||number||min:10"
                        placeholder="Số điện thoại">
                </div>
                <div class="form-group" style="flex:1">
                    <input type="text" class="w-100 p-2" name="email" rules="required||email" placeholder="Email">
                </div>
            </div>
            <button type="submit" class="btn-all py-1 btn-all-main float-end"> Bình luận</button>
        </form>
    </div>
    <p class="comment-box__title side-bar-title small">Bình luận</p>
    <div class="comment-box__list">
        @include('path.comment')
    </div>
    @if ($comments->lastPage() > $comments->currentPage())
        <button type="button" class="more-comment" page-table="{{ $map_table }}" page-id="{-currentItem.id-}"
            page-current="{{ $comments->currentPage() }}">Xem thêm</button>
    @endif

</div>
