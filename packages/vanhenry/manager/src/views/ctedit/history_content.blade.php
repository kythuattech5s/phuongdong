@php
    $name = FCHelper::er($table,'name');
    $defaultData = FCHelper::er($table,'default_data');
    $arrKey = json_decode($defaultData,true);
    
    if(is_object($dataItem)){
        $histories = FCHelper::getHistories($arrKey,$dataItem);
    }else{
        $histories = [];
    }

    $classifies = [];
    foreach($histories as $history){
        $classifies[$history->type][] = $history;
    }
@endphp
@if(count($classifies) > 0)
<style>
    .history{
        margin-bottom: 12px;
    }
    .history .modal-dialog{
        width: 90%;
    }
   
    .compare-item .compare-item__old,
    .compare-item .compare-item__new{
        height: 70vh;
        overflow: auto;
        padding:8px 12px;
        width: 50%;
        box-shadow: inset 0 0 3px black
    }
    .compare-item.active{
        display: flex;
        animation: opacity 0.5s ease-in-out forwards;
        gap: 10px;
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
                            <select name="" id="" class="select2">
                                @foreach($classify as $content)
                                    @php
                                        $user = FCHelper::getHUserById($content->h_user_id);
                                    @endphp
                                <option value="{{$content->id}}"> {{ $user->name. ' - ' . date('H:i H:i:s')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-body__compare">
                            @foreach($classify as $content)
                            <div class="compare-item {{$loop->first ? 'active' : ''}}" data-item="{{$content->id}}">
                                <div class="compare-item__old">
                                    <b class="compare-item__item">Nội dung</b>
                                    <div class="s-content">
                                        {!! $content->content_old !!}
                                    </div>
                                </div>
                                <div class="compare-item__new">
                                    <b class="compare-item__item">Nội dung thay đổi</b>
                                    <div class="s-content">
                                        {!! $content->content !!}
                                    </div>
                                </div>
                            </div>
                            <div id="output">
                                    
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-success choose-item-previous">Quay lại bản ghi</button>
                        <button  type="button" class="btn btn-primary choose-item-news">Lấy nội dung thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<script>
    @foreach($classifies as $type => $classify)
        $('#{{$type.'-'.$name}}').on('shown.bs.modal', function () {
            loadContent();
        })
    @endforeach
    function loadContent(){
        var new_html = $('.compare-item.active .compare-item__new .s-content');
        var old_html = $('.compare-item.active .compare-item__old .s-content').html();
        let output = htmldiff(old_html, new_html.html());
        new_html.html(output);
    }
    
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
            loadContent();
        })
    }
    changeItem();

    function chooseItem(){
        $('.choose-item-news').click(function(e){
            e.preventDefault();
            bootbox.confirm({
                message: "Bạn muốn thay đổi nội dung?",
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
                        $('textarea.editor').tinymce().setContent($('.compare-item.active .compare-item__new .s-content').html());
                        $('.modal').modal('hide');
                    }
                }
            });
        })
        
        $('.choose-item-previous').click(function(e){
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
                        $('textarea.editor').tinymce().setContent($('.compare-item.active .compare-item__old .s-content').html());
                        $('.modal').modal('hide');
                    }
                }
            });
        })
    }
    chooseItem();
</script>
@endif