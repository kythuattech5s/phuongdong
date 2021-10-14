<td data-title="{{$show->note}}" style="text-align: left;">
	@php
		$userCreateId = (int)FCHelper::ep($dataItem,$show->name);
		$userCreate = \vanhenry\manager\model\HUser::find($userCreateId);
		$param = '';
		if(isset($table_history_config) || ($tableData->get('table_map', '') == 'h_histories' && isset(request()->raw_table_name) && request()->raw_table_name == 'news')){
			$param = '&raw_table_name='.($table_history_config ?? 'news');
		}
	@endphp
	@if (isset($userCreate))
	<p>
		<a href="{{$admincp}}/search/{{$tableData->get('table_map','')}}?raw_{{$show->name}}={{$userCreateId}}{{$param}}">
			{{$userCreate->name}}
		</a>
	</p>
	@endif
</td>