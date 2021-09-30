@php
    if(isset($check)){
        $user = Auth::guard('h_users')->user()->with('hGroupUser')->find(Auth::guard('h_users')->id());
        if($user->hGroupUser !== null && $user->hGroupUser->hActions->count() > 0){
            $deleted = $user->hGroupUser->hActions->filter(function($v){
                return $v->key == "DELETE";
            });

            $deleted_now = $user->hGroupUser->hActions->filter(function($v){
                return $v->key == "DELETE_NOW";
            });
        }
    }
@endphp
@if(isset($check))
    @if($check == 'DELETE_NOW')
        <a href="{{$admincp}}/backtrash/{{$tableData->get('table_map','')}}" class="_vh_delete_permanent _vh_backtrash tooltipx {{trans('db::delete')}} {{$tableData->get('table_map','')}}"><i class="fa fa-undo" aria-hidden="true"></i>
            <span class="tooltiptext">Khôi phục</span>
        </a>
    @endif
    @if(isset($deleted_now) && $deleted_now->count() > 0 && $check == "DELETE")
        <a href="{{$admincp}}/trash/{{$tableData->get('table_map','')}}" class="_vh_delete_permanent _vh_trash tooltipx {{trans('db::delete')}} {{$tableData->get('table_map','')}}"><i class="fa fa-trash-o" aria-hidden="true"></i>
            <span class="tooltiptext">Xóa tạm</span>
        </a>
        <a href="{{$admincp}}/delete/{{$tableData->get('table_map','')}}" class="_vh_delete_permanent _vh_delete tooltipx {{trans('db::delete')}} {{$tableData->get('table_map','')}}"><i class="fa fa-times-circle" aria-hidden="true"></i>
            <span class="tooltiptext">Xóa vĩnh viễn</span>
        </a>
    @elseif($check == "DELETE" && isset($deleted))
        <a href="{{$admincp}}/trash/{{$tableData->get('table_map','')}}" class="_vh_delete_permanent _vh_trash tooltipx {{trans('db::delete')}} {{$tableData->get('table_map','')}}"><i class="fa fa-trash-o" aria-hidden="true"></i>
            <span class="tooltiptext">Xóa tạm</span>
        </a>
    @endif
@else
    @if($has_delete)
    <a href="{{$admincp}}/delete/{{$tableData->get('table_map','')}}" class="_vh_delete_permanent _vh_delete tooltipx {{trans('db::delete')}} {{$tableData->get('table_map','')}}"><i class="fa fa-times-circle" aria-hidden="true"></i>
        <span class="tooltiptext">Xóa vĩnh viễn</span>
    </a>
    @endif
@endif