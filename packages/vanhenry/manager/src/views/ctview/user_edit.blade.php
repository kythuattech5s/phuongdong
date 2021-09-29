<td data-title="{{$show->note}}" style="text-align: left;">
	@php
		$userUpdateId = (int)FCHelper::ep($dataItem,$show->name);
		$userUpdate = \vanhenry\manager\model\HUser::find($userUpdateId);
	@endphp
	@if (isset($userUpdate))
	<p>
		<a href="{{$admincp}}/search/{{$tableData->get('table_map','')}}?raw_{{$show->name}}={{$userUpdateId}}">
			{{$userUpdate->name}}
		</a>
	</p>
	@endif
</td>