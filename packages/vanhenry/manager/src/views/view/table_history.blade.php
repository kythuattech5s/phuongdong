<div class="pagination">
    <span class="total">{{ trans('db::number_record') }}: <strong>{{ $listData->total() }}</strong></span>
    {{ $listData->withQueryString()->links('vendor.pagination.pagination') }}
</div>
<div id="no-more-tables" class="row m0">
    <div class="tablecontrol none">
        @php
            if (isset($check)) {
                $user = Auth::guard('h_users')
                    ->user()
                    ->with('hGroupUser')
                    ->find(Auth::guard('h_users')->id());
                if ($user->hGroupUser !== null && $user->hGroupUser->hActions->count() > 0) {
                    $deleted = $user->hGroupUser->hActions->filter(function ($v) {
                        return $v->key == 'DELETE';
                    });
            
                    $deleted_now = $user->hGroupUser->hActions->filter(function ($v) {
                        return $v->key == 'DELETE_NOW';
                    });
                }
            }
        @endphp
        @if (isset($check))
            @if (isset($deleted_now) && $deleted_now->count() > 0)
                <a class="_vh_action_all btn btn-danger" data-confirm="Bạn có thực sự muốn xóa?"
                    href="{{ $admincp }}/deleteAll/{{ $tableData->get('table_map', '') }}"
                    title="{{ trans('db::delete_all') }} {{ $tableData->get('name', '') }}"><i class="fa fa-trash"
                        aria-hidden="true"></i> {{ trans('db::delete_all') }}</a>
            @endif
        @else
            <a class="_vh_action_all btn btn-danger" data-confirm="Bạn có thực sự muốn xóa?"
                href="{{ $admincp }}/deleteAll/{{ $tableData->get('table_map', '') }}"
                title="{{ trans('db::delete_all') }} {{ $tableData->get('name', '') }}"><i class="fa fa-trash"
                    aria-hidden="true"></i> {{ trans('db::delete_all') }}</a>
        @endif
        @php
            $data_actions = $tableData->get('default_action_all', []);
            $data_actions = json_decode($data_actions, true);
        @endphp
        @if (isset($check) && isset($deleted_now) && $deleted_now->count() > 0)
            @if ($data_actions !== null && count($data_actions) > 0)
                @foreach ($data_actions as $action)
                    <a class="_vh_action_all btn btn-danger" data-confirm="{{ $action['message'] }}"
                        href="{{ $admincp }}/{{ $action['href'] }}/{{ $tableData->get('table_map', '') }}"
                        tite="{{ $action['title'] }}">
                        {!! $action['icon'] !!}
                        {{ $action['title'] }}
                    </a>
                @endforeach
            @endif
        @endif
        @if ($tableData->get('table_parent', '') != '')
            <a href="#" data-toggle="modal" data-target="#addToParent" class="_vh_add_to_parent"
                title="Thêm vào danh mục cha"><i class="fa fa-puzzle-piece" aria-hidden="true">Thêm vào danh mục cha</i>
            </a>
            <a href="#" title="Xóa khỏi danh mục cha" data-toggle="modal" data-target="#addToParent"
                class="_vh_remove_from_parent"><i class="fa fa-chain-broken" aria-hidden="true">Xóa khỏi danh mục
                    cha</i></a>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.double-scroll').doubleScroll();
        });
    </script>
    <div class="main_table double-scroll">
        <table class="col-md-12 table-bordered table-striped table-condensed cf p0 table-data-view">
            <thead class="cf">
                <tr>
                    {%FILTER.simpleShow.filterShow.tableDetailData%}
                    <th>STT</th>
                    @foreach ($simpleShow as $show)
                        @php
                            $urlSorts = Support::buildUrlSort($show);
                        @endphp
                        @if ($show->hide !== 1)
                            <th class="{{ $urlSorts['cursor'] }}" data-href="{{ $urlSorts['url_sort'] }}">
                                {{ $show->note }}
                                @if ($urlSorts['ordervalue'] == 'asc')
                                    <i class="fa fa-sort-asc" aria-hidden="true"></i>
                                @elseif($urlSorts['ordervalue'] == 'desc')
                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                @endif
                            </th>
                        @endif
                    @endforeach
                   
                </tr>
            </thead>
            <tbody>
                <?php $urlFull = base64_encode(Request::fullUrl()); ?>
                @for ($i = 0; $i < $listData->count(); $i++)
                    <?php $itemMain = $listData->get($i); ?>
                    <tr>
                        <td data-title="STT">{{ $i + 1 }}</td>
                        @foreach ($simpleShow as $show)
                            @php
                                $viewView = 'vh::ctview.' . strtolower(FCHelper::er($show, 'type_show'));
                                $viewView = View::exists($viewView) ? $viewView : 'vh::ctview.base';
                            @endphp
                            @if ($show->hide !== 1)
                                @include($viewView,array('item'=>$show,'dataItem'=>$itemMain))
                            @endif
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <span class="total">{{ trans('db::number_record') }}:<strong>
                {{ $listData->total() }}</strong></span>
        {{ $listData->withQueryString()->links('vendor.pagination.pagination') }}
    </div>
</div>
