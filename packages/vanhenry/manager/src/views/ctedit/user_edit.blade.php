@if ($actionType == 'edit')
	@php
		$name = FCHelper::er($table,'name');
		$userAdmin = \Auth::guard('h_users')->user();
	@endphp
	<input type="hidden" name="{{$name}}" id="{{$name}}"  class="form-control" dt-type="{{FCHelper::ep($table,'type_show')}}" value="{{$userAdmin->id}}" />
@endif