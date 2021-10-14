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
			<div class="header-top aclr">
				<div>
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
			<div id="home" class="tab-pane fade in active">
				@include('vh::ctview.filter',['history_table_name'=>$table_history_config])
				<div id="main-table">
					@include('vh::view.table_history',['tableData'=>$tableData])
				</div>
			</div>
		</div>
	</div>
	@include('vh::static.footer')
</div>
@stop
@section('more')
@stop