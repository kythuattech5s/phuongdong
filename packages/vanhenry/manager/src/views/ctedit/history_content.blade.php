@php
    $name = FCHelper::er($table,'name');
    $defaultData = FCHelper::er($table,'default_data');
    $arrKey = json_decode($defaultData,true);
    $histories = FCHelper::getHistories($arrKey,$dataItem);
    $classifies = [];
    foreach($histories as $history){
        $classifies[$history->type][] = $history;
    }
@endphp
<style>
    .history .modal-dialog{
        width: 90%;
    }
   
    .compare-item .compare-item__old,
    .compare-item .compare-item__new{
        height: 70vh;
        overflow: auto;
        padding:8px 12px;
    }
    .compare-item.active{
        display: flex;
        animation: opacity 0.5s ease-in-out forwards;
    }

    .compare-item img{
        width: 100%;
    }
    .compare-item{
        display: none;
        opacity: 0;
    }

    @keyframes opacity{
        to{
            opacity: 1;
        }
    }
</style>
<div class="history">
    <p class="form-title"> Lịch sử thay đổi</p>
    @foreach($classifies as $type => $classify)
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$type.'-'.$name}}">
            {{count($classify)}} {{$type == 'auto' ? 'phiên bản tự động lưu' : 'bản xem lại'}}
        </button>
        <div id="{{$type.'-'.$name}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Bản ghi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Chọn bản ghi</label>
                            <select name="" id="">
                                @foreach($classify as $content)
                                    @php
                                        $user = FCHelper::getHUserById($content->h_user_id);
                                    @endphp
                                <option value="{{$content->id}}"> {{ $user->name. ' - ' . $content->created_at}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-body__compare">
                            @foreach($classify as $content)
                            <div class="compare-item {{$loop->first ? 'active' : ''}}" data-item="{{$content->id}}">
                                <div class="compare-item__old">
                                    {!! $content->content_old !!}
                                </div>
                                <div class="compare-item__new">
                                    {!! $content->content !!}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-success choose-item">Thay bản ghi</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
<script>
    function changeItem(){
        $('.history select').change(function(){
            const _this = $(this);
            const items = $('.compare-item');
            $.each(items, function(k,e){
                if($(e).hasClass('active')){
                    $(e).removeClass('active');
                };
                if(_this.val() == $(e).data('item')){
                    $(e).addClass('active');
                };
            })
        })
    }
    changeItem();

    function chooseItem(){
        $('.choose-item').click(function(e){
            e.preventDefault();
            bootbox.confirm({
                message: "Bạn muốn đổi về bản ghi này?",
                buttons: {
                    confirm: {
                        label: 'Đồng ý',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Không',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result){
                        $('textarea.editor').tinymce().setContent($('.compare-item active .compare-item__new').html());
                    }
                }
            });
        })
    }
    chooseItem();
</script>