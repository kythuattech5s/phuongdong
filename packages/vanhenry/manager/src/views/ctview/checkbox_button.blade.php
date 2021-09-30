<?php 
$user = Auth::guard('h_users')->user()->with('hGroupUser')->find(Auth::guard('h_users')->id());
	if($user->hGroupUser !== null && $user->hGroupUser->hActions->count() > 0){
		$active = $user->hGroupUser->hActions->filter(function($v){
			return $v->key == 'ACTIVE';
		});
	// dd($active);
  }
$value = FCHelper::ep($dataItem,$show->name);
?>
<td data-title="{{$show->note}}">
  <input dt-prop="{{$show->is_prop ?? 0}}" dt-prop-id="{{$show->id}}" type="checkbox" data-off-label="false" data-on-label="false" data-off-icon-cls="glyphicon-remove"  name="{{$show->name}}" {{$value == 1?'checked':''}} data-on-icon-cls="glyphicon-ok" class="ccb {{( isset($active) && $active->count() > 0 && $show->editable == 1 ) ? 'editable' : ''}}" />
</td>
