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
    }

    .compare-item img{
        width: 100%;
    }

    .compare-item{
        display: none;
    }
</style>
<div class="history">
    @foreach($classifies as $type => $classify)
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$type.'-'.$name}}">
            {{count($classify)}} {{$type == 'auto' ? 'bản tự động lưu' : 'bản xem lại'}}
        </button>
        <div id="{{$type.'-'.$name}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bản ghi</h4>
                </div>
                <div class="modal-body">
                    <select name="" id="">
                        @foreach($classify as $content)
                            @php
                                $user = FCHelper::getHUserById($content->h_user_id);
                            @endphp
                        <option value="{{$content->id}}"> {{ $user->name. '-' . $content->created_at}}</option>
                        @endforeach
                    </select>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Thay bản ghi</button>
                </div>
                </div>
            </div>
            </div>
        </div>
    @endforeach
<script>
    function 
</script>