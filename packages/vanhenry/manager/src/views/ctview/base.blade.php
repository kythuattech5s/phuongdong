<td data-title="{{$show->note}}" style="text-align: left;{{$show->name == 'name' || $show->name == 'note' ? 'white-space: normal;min-width: 300px;':'';}}{{$show->name == 'ord' ? 'width: 50px;':'';}}">{{ strip_tags(FCHelper::ep($dataItem,$show->name))}}</td>