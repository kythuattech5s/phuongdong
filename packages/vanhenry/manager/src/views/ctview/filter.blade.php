@php
    $has_history = $tableData->get('has_history', '') == 1;
    $arrayIncludesHistory = ['news']
@endphp
<div class="filter-table">
    {%FILTER.advanceSearchs.filterAdvanceSearch.tableDetailData%}
    {%FILTER.simpleSearch.filterSimpleSearch.tableDetailData%}
    {%FILTER.simpleSort.filterSimpleSort.tableDetailData%}
    @if (isset($dataSearch))
        @php
            if (isset($dataSearch['raw_' . $simpleSearch->name]) && $dataSearch['raw_' . $simpleSearch->name] !== 'raw_' . $simpleSearch->name) {
                $simple_search_value = $dataSearch['raw_' . $simpleSearch->name];
            } else {
                $simple_search_value = '';
            }
        @endphp
    @endif
    <form id="frmsearch" action="{{ $admincp }}/search/{{ $tableData->get('table_map', '') }}"
        class="">
        <div class="filter-table__top">
            <div class="group-filter--left">
                @if (isset($key))
                    <input type="hidden" name="tab" value="{{ $key }}">
                @endif
                @if(isset($history_table_name) || ($tableData->get('table_map', '') == 'h_histories' && isset(request()->raw_table_name) && in_array(request()->raw_table_name,$arrayIncludesHistory) ))
                    <input type="hidden" name="raw_table_name" value="{{$history_table_name ?? request()->raw_table_name}}">
                @endif
                @if ($simpleSearch !== null)
                    <div class="filter-group">
                        <input type="text" name="raw_{{ $simpleSearch->name }}"
                            placeholder="{{ trans('db::search') }} {{ trans('db::as') }} {{ FCHelper::ep($simpleSearch, 'note') }}"
                            value="{{ @$simple_search_value }}">
                    </div>
                @endif
                @if (@$advanceSearchs)
                    @foreach ($advanceSearchs as $search)
                        @if (in_array(strtolower($search->type_show), ['pivot', 'select', 'user_create', 'user_edit', 'select_checkbox']))
                            @if (in_array(strtolower($search->type_show), ['pivot', 'select', 'select_checkbox']))
                                @if (strtolower($search->type_show) == 'pivot')
                                    <input name="search-{{ $search->name }}" value="none" type="hidden">
                                    <input name="type-{{ $search->name }}" value="PIVOT" type="hidden">
                                @endif
                                @php
                                    $dataDefault = json_decode($search->default_data, true);
                                    // dd($dataDefault);
                                    if (isset($dataDefault['target_table'])) {
                                        $dataValues = DB::table($dataDefault['target_table'])
                                            ->select($dataDefault['target_select'])
                                            ->get();
                                    } elseif (isset($dataDefault['data']) && isset($dataDefault['data']['table'])) {
                                        $dataValues = DB::table($dataDefault['data']['table'])
                                            ->select(explode(',', $dataDefault['data']['select']))
                                            ->get();
                                    } else {
                                        $dataValues = $dataDefault['data'];
                                    }
                                @endphp
                            @elseif(in_array(strtolower($search->type_show),['user_create','user_edit']))
                                @php
                                    $dataValues = DB::table('h_users')
                                        ->select(['id', 'name'])
                                        ->get();
                                @endphp
                            @endif
                            <div class="filter-group">
                                <select
                                    name="{{ strtolower($search->type_show) == 'pivot' ? '' : 'raw_' }}{{ $search->name }}"
                                    id="" class="select2" style="width:250px">
                                    <option value="">-- {{ $search->note }} --</option>
                                    @foreach (@$dataValues as $data)
                                        @php
                                            $type_show_value = strtolower($search->type_show) == 'pivot' ? $search->name : 'raw_' . $search->name;
                                            if (isset($dataSearch) && isset($dataSearch[$type_show_value]) && $dataSearch[$type_show_value] == ($data->id ?? $data['key'])) {
                                                $selectedFilter = 'selected';
                                            } else {
                                                $selectedFilter = '';
                                            }
                                        @endphp
                                        <option value="{{ $data->id ?? $data['key'] }}" {{ $selectedFilter }}>
                                            {{ $data->name ?? $data['vi_value'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif(in_array(strtolower($search->type_show),['datetime']))
                            <input name="search-{{ $search->name }}" value="none" type="hidden">
                            <input name="type-{{ $search->name }}" value="DATETIME" type="hidden">
                            <div class="filter-group">
                                @php
                                    if (isset($dataSearch['from-' . $search->name])) {
                                        $valueFrom = $dataSearch['from-' . $search->name];
                                    } else {
                                        $valueFrom = '';
                                    }
                                    
                                    if (isset($dataSearch['to-' . $search->name])) {
                                        $valueTo = $dataSearch['to-' . $search->name];
                                    } else {
                                        $valueTo = '';
                                    }
                                @endphp
                                <input type="text" class="datepicker-filter" name="from-{{ $search->name }}"
                                    placeholder="-- {{ $search->note }} từ --" value="{{ $valueFrom }}"
                                    autocomplete="off">
                                <input type="text" class="datepicker-filter" name="to-{{ $search->name }}"
                                    placeholder="-- {{ $search->note }} đến --" value="{{ $valueTo }}"
                                    autocomplete="off">
                            </div>
                        @elseif(in_array(strtolower($search->type_show),['text','slug']))
                            <div class="filter-group">
                                @php
                                    if (isset($dataSearch['raw_' . $search->name])) {
                                        $value = $dataSearch['raw_' . $search->name];
                                    } else {
                                        $value = '';
                                    }
                                @endphp
                                <input type="text" name="raw_{{ $search->name }}"
                                    placeholder="{{ $search->note }}" value="{{ $value }}">
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            @if(isset($history_table_name) || ($tableData->get('table_map', '') == 'h_histories' && isset(request()->raw_table_name) && in_array(request()->raw_table_name,$arrayIncludesHistory) ))
                <a class="refresh" href="{{ url('esystem/history/'.($history_table_name ?? request()->raw_table_name ).'/0')  }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
            @else
                <a class="refresh" href="{{ url('esystem/view/' . $tableData['table_map'] . (isset($key) ? '?tab=' . $key : '')) }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                @endif
        </div>
        <div class="filter-table__bottom">
            <p class="filter-table__sort-title">Sắp xếp</p>
            <div class="filter-group">
                <select name="orderkey" class="select2" style="width:160px">
                    {%FILTER.simpleSort.filterSimpleSort.tableDetailData%}
                    @foreach ($simpleSort as $ss)
                        @if (isset(request()->orderkey) && request()->orderkey == $ss->name)
                            <option {{ request()->orderkey == $ss->name ? 'selected' : '' }}
                                value="{{ $ss->name }}">{{ $ss->note }}</option>
                        @elseif(!isset($dataSearch) || $dataSearch['orderkey'] == 'id')
                            <option {{ $ss->type_show == 'PRIMARY_KEY' ? 'selected' : '' }}
                                value="{{ $ss->name }}">{{ $ss->note }}</option>
                        @else
                            <option {{ $ss->name == $dataSearch['orderkey'] ? 'selected' : '' }}
                                value="{{ $ss->name }}">{{ $ss->note }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <select name="ordervalue" class="select2" style="width:100px">
                    @if (isset($dataSearch['ordervalue']))
                        <option {{ $dataSearch['ordervalue'] == 'desc' ? 'selected' : '' }} value="desc">
                            {{ trans('db::from') }} Z->A</option>
                        <option {{ $dataSearch['ordervalue'] == 'asc' ? 'selected' : '' }} value="asc">
                            {{ trans('db::from') }} A->Z</option>
                    @elseif(isset(request()->ordervalue))
                        <option {{ request()->ordervalue == 'desc' ? 'selected' : '' }} value="desc">
                            {{ trans('db::from') }} Z->A</option>
                        <option {{ request()->ordervalue == 'asc' ? 'selected' : '' }} value="asc">
                            {{ trans('db::from') }} A->Z</option>
                    @else
                        <option selected value="desc">{{ trans('db::from') }} Z->A</option>
                        <option value="asc">{{ trans('db::from') }} A->Z</option>
                    @endif
                </select>
            </div>
            <div class="filter-group">
                <select name="limit" class="select2" style="width:80px">
                    {{-- <option {{isset($dataSearch) && $dataSearch['limit'] == 10 ? 'selected' : ''}} value="10">10</option> --}}
                    <option {{ isset($dataSearch) && $dataSearch['limit'] == 20 ? 'selected' : '' }} value="20">20
                    </option>
                    <option {{ isset($dataSearch) && $dataSearch['limit'] == 50 ? 'selected' : '' }} value="50">50
                    </option>
                    <option {{ isset($dataSearch) && $dataSearch['limit'] == 100 ? 'selected' : '' }} value="100">100
                    </option>
                </select>
            </div>
            @if($has_history)
            <div class="filter-group">
                <a href="{{ url('esystem/history/'. $tableData['table_map'].'/0') }}"><i class="fa fa-history" aria-hidden="true"></i> Lịch sử thay đổi</a>
                </div>
            @endif
            @if(isset($history_table_name) || ($tableData->get('table_map', '') == 'h_histories' && isset(request()->raw_table_name) && in_array(request()->raw_table_name,$arrayIncludesHistory)  ))
                <div class="filter-group">
                    <a href="{{ url('esystem/view/'. ($history_table_name ?? request()->raw_table_name)) }}"> <i class="fa fa-list" aria-hidden="true"></i> Quay lại danh sách</a>
                </div>
            @endif
        </div>
    </form>
</div>
