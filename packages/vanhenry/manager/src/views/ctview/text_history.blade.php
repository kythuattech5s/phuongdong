<td data-title="{{$show->note}}" style="text-align: left;{{$show->name == 'name' || $show->name == 'note' ? 'white-space: normal;min-width: 300px;':'';}}{{$show->name == 'ord' ? 'width: 50px;':'';}}">
	@if($show->name == 'name')
		<p><a href="{{$admincp}}/edit/{{$tableData->get('table_map','')}}/{{FCHelper::ep($itemMain,'id')}}?returnurl={{$urlFull}}">
			{{FCHelper::ep($dataItem,$show->name)}}
		</a></p>
		@if (isset($itemMain->slug))
			<p><a href="{{url($itemMain->slug.'/')}}" class="smooth" title="Xem trước" target="_blank"><strong>(Xem trước)</strong></a></p>
		@endif
		<input type="hidden" dt-prop="{{$show->is_prop ?? 0}}" dt-prop-id="{{$show->id}}" class="{{$show->editable==1?'editable':''}}"  name="{{$show->name}}" title="{{$show->note}}" value="{{FCHelper::ep($dataItem,$show->name)}}" type="text" disabled />
	@else
        <p><a href="{{$admincp}}/edit/{{$itemMain->table_name}}/{{FCHelper::ep($itemMain,'target_id')}}?returnurl={{$urlFull}}">
            {{FCHelper::ep($dataItem,$show->name)}}
        </a></p>
	@endif
</td>