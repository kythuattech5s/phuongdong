@php
$table = $dataItem->table_name;
switch ($dataItem->action ?? true) {
    case 'insert':
    $name_action = 'Thêm';
        break;
    case 'update':
    $name_action = 'Sửa';
        break;
    case 'delete':
    $name_action = 'Xóa';
        break;
    default:
    $name_action = '';
        break;
}
$values = DB::table('v_detail_tables')
    ->select(['name', 'note', 'parent_name'])
    ->where('parent_name', $table)
    ->whereIn('name', explode(',', $dataItem->field_change))
    ->pluck('note');
@endphp
<td>
    @forelse ($values as $value)
        {!! '<p>'.Str::ucfirst(Str::lower($name_action.' '.$value)).'</p>' !!}
    @empty
        {{$name_action}}
    @endforelse
</td>
