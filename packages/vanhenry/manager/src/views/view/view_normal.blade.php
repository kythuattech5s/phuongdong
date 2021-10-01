@extends('vh::master')
@section('css')
@if($tableData->get('has_yoast_seo','') == 1)
<link rel="stylesheet" href="admin/tech5s_yoast_seo/theme/css/yoastseo.css" type="text/css">
@endif
@endsection
@section('content')
<a href="{{$admincp}}/editableajax/{{$tableData->get('table_map','')}}" class="hidden" id="editableajax"></a>
<div class="header-top aclr">
	<div class="breadc pull-left">
		<ul class="aclr pull-left list-link">
			<li class="active"><a  href="{{$admincp}}/view/{{$tableData->get('table_map','')}}">{{FCHelper::ep($tableData,'name')}}</a></li>
		</ul>
	</div>


	@if($tableData->get("has_export","")==1)
	<div class="breadc pull-right">
		<a href="{{$admincp}}/export/{{$tableData->get('table_map','')}}">Xuất file excel <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 20px; padding-left: 10px;"></i>
		</a>
	</div>
	@endif
</div>
<div id="maincontent">
	<div class="listcontent">
		<ul class="nav nav-tabs">
			@if($tableData->get("has_trash","")==1)
				<li class=""><a  href="{{$admincp}}/trashview/{{$tableData->get('table_map','')}}">{{trans('db::trash')}}</a></li>
			@endif
			@if($transTable != null)
				<li>
					<ul class="table-lang view">
						<?php $tableLangs = \Session::get('_table_lang') ?>
						@foreach($locales as $localeCode => $v)
						<li><a href="{{$admincp}}/table-lang/{{$tableData->get('table_map','')}}/{{$localeCode}}" class="{{(isset($tableLangs[$tableData->get('table_map')]) && $tableLangs[$tableData->get('table_map')] == $localeCode) || (!isset($tableLangs[$tableData->get('table_map')]) && $localeCode == Config::get('app.locale_origin')) ? 'active' : ''}}">{{$v}}</a></li>
						@endforeach
					</ul>
				</li>
			@endif
			@if($tableData->get('has_draft','') == 1 && isset($tab))
				@foreach($tab as $key => $detailTab)

				@php
					if(isset(request()->tab) && $key == request()->tab){
						$active_tab = 'active';
					}elseif(!isset(request()->tab)){
						$active_tab = $loop->first ? 'active' : '';
					}else{
						$active_tab = '';
					}
				@endphp
				<li class="{{$active_tab}}">
					<a class="pull-right bgmain" href="{{url()->current().'?tab='.$key}}">
						{{$detailTab['name']}}
						@if(in_array($key,['scheduled','trash']))
							<span class="count">
								{{$listData[$key]->total()}}
							</span>
						@endif
					</a>
				</li>
				@endforeach
			@endif
			<div class="header-top aclr">
				{{--
				<div class="breadc pull-left">
					<ul class="aclr pull-left list-link">
						<li class="pull-left"><a href="{{$admincp}}">{{trans('db::home')}}</a></li>
					</ul>
					<?php $exs = \Event::dispatch('vanhenry.manager.headertop.view',[]); ?>
					@foreach ($exs as $exk => $exvs)
					@if(is_array($exvs))
					@foreach($exvs as $exvv)
					@include($exvv)
					@endforeach
					@endif
					@endforeach
				</div>
				--}}
				<div>
					{{-- <a class="pull-right bgmain1 viewsite" target="_blank" href="{{asset('/')}}">
						<i class="fa fa-external-link" aria-hidden="true"></i>
						<span  class="clfff">{{trans('db::see_website')}}</span> 
					</a>
					@if($tableData->get("has_import","")==1)
					<a class="pull-right bgmain viewsite " href="{{$admincp}}/import/{{$tableData->get('table_map','')}}">
						<i class="fa fa-cloud-upload" aria-hidden="true"></i>
						<span  class="clfff">Import</span> 
					</a>
					@endif
					<a class="pull-right btn-func tooltipx bottom" href="{{$admincp}}/deleteCache">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
						<span class="tooltiptext ">{{trans('db::delete_cache')}}</span>
					</a>
					@if($tableData->get('table_map', '') == 'users' || $tableData->get('table_map', '') == 'register_events')
					<button type="button" class="btn btn-success pull-right btnexcel" style="right: 0px;position: relative;" rel="{{$admincp}}/export/{{$tableData->get('table_map','')}}">Export to file Excel</button>
					@endif --}}
					@if($tableData->get('has_insert','')==1 && is_int(strpos($tableData->get('table_map'),'order')) == false)
						<?php $urlFull = base64_encode(Request::fullUrl()); ?>
						<a class="pull-right bgmain viewsite " href="{{$admincp}}/insert/{{$tableData->get('table_map','')}}?returnurl={{$urlFull}}">
							<i class="fa fa-file-o" aria-hidden="true"></i>
							<span  class="clfff">{{trans('db::add')}}</span> 
						</a>
					@endif
				</div>
			</div>
		</ul>
		<div class="tab-content">
			@if(isset($tab))
				@foreach($tab as $key => $detailTab)
				@php
					if(isset(request()->tab) && $key == request()->tab){
						$active_tab = 'active';
					}elseif(!isset(request()->tab)){
						$active_tab = $loop->first ? 'active' : '';
					}else{
						$active_tab = '';
					}
				@endphp
					@if( (isset(request()->tab) && request()->tab == $key) || (!isset(request()->tab) && $key == 'home') )
						<div id="{{$key}}" class="tab-pane fade in {{ $active_tab }}">
							@include('vh::ctview.filter')
							<div id="main-table">
								@include('vh::view.table',['tableData'=>$tableData,'listData' => $listData[$key], 'check' => $detailTab['check'],'dataKey' => $key])
							</div>
						</div>
					@endif
				@endforeach
			@else
				<div id="home" class="tab-pane fade in active">
					@include('vh::ctview.filter')
					<div id="main-table">
						@include('vh::view.table',['tableData'=>$tableData])
					</div>
				</div>
			@endif
		</div>
	</div>
	@if(strpos($tableData->get('table_map'),'order') !== false)
		<div class="modalOrder">
		</div>
		<script src="theme/frontend/js/moment.min.js" defer></script>
		<link rel="stylesheet" href="theme/frontend/css/daterangepicker.css">
		<script src="theme/frontend/js/daterangepicker.js" defer=""></script>
		<script type="text/javascript" src="admin/js/order.js" defer></script>
	@endif
	@include('vh::static.footer')
</div>
@stop
@section('more')
@if($tableData->get('table_parent','')!='')
@include('vh::view.addToParent')
@endif
@stop