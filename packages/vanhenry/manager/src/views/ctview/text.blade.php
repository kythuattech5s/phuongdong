<td data-title="{{$show->note}}">
	@if($show->name == 'name')
	<a href="{{$admincp}}/edit/{{$tableData->get('table_map','')}}/{{FCHelper::ep($itemMain,'id')}}?returnurl={{$urlFull}}">{{FCHelper::ep($dataItem,$show->name)}}</a>
	<input type="hidden" dt-prop="{{$show->is_prop ?? 0}}" dt-prop-id="{{$show->id}}" class="{{$show->editable==1?'editable':''}}"  name="{{$show->name}}" title="{{$show->note}}" value="{{FCHelper::ep($dataItem,$show->name)}}" type="text" disabled />
	@else
	<input dt-prop="{{$show->is_prop ?? 0}}" dt-prop-id="{{$show->id}}" class="{{$show->editable==1?'editable':''}}"  name="{{$show->name}}" title="{{$show->note}}" value="{{FCHelper::ep($dataItem,$show->name)}}" type="text" disabled />
	@endif
</td>