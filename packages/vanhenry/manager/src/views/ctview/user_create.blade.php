<td data-title="{{$show->note}}" style="text-align: left;">
	@php
		$userCreateId = (int)FCHelper::ep($dataItem,$show->name);
		$userCreate = \vanhenry\manager\model\HUser::find($userCreateId);
	@endphp
	@if (isset($userCreate))
	<p>
		<a href="{{$admincp}}/search/{{$tableData->get('table_map','')}}?raw_{{$show->name}}={{$userCreateId}}">
			{{$userCreate->name}}
		</a>
	</p>
	@endif
</td>