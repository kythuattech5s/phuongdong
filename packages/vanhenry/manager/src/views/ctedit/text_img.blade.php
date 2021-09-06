@php

	

	$name = FCHelper::er($table,'name');

	$value ="";

	if($actionType=='edit'||$actionType=='copy'){

		$value = $dataItem->$name;

	}

	$jsons = json_decode($value,true); $jsons = @$jsons?$jsons:[]; 

@endphp

<div class="form-group">

	<p class="form-title" for="">{{FCHelper::er($table,'note')}} <span class="count"></span></p>

	<textarea class="hidden" name="{{$name}}"><?php echo $value;  ?></textarea>

	<div class="textv2-{{$name}}">

		@foreach($jsons as $key => $json)

			<div class="item">

				<div class="row" style="padding-top: 6px;padding-bottom: 6px">

					<div class="col-md-3">

						<label style="padding-left: 10px;">Nội dung</label>

					</div>

					<div class="col-md-9">

						<div style="padding-right: 10px;">

							<input class="name-{{$name}}" value="{{isset($json['name'])?$json['name'] :''}}">

						</div>

					</div>

				</div>

				<div class="text-center" style="margin-bottom: 6px;">

					<button type="button" class="delete">Xóa</button>

				</div>

			</div>

		@endforeach

	</div>

	<div class="text-center" style="width: 80%;">

		<button type="button" class="add-{{$name}}">Thêm</button>

	</div>

</div>

<style type="text/css">

	.textv2-<?php echo $name ?>{

	    border: 1px solid #00923f;

		width: 80%;

		margin: 10px 0px;

		display: flex;

		flex-wrap: wrap;

	}

	.textv2-<?php echo $name ?> .item{

		width: calc(50% - 20px);

		margin: 5px;

		border: 1px solid #ccc;

	}

	.textv2-<?php echo $name ?> .item input, .textv2-<?php echo $name ?> .item textarea{

		width: 100% !important;

		padding: 0px 10px;

	}

</style>

<script type="text/javascript">

	$(function() {

		function calculate<?php echo $name ?>(){

			var textv2 = $(".textv2-<?php echo $name ?> .item");

			var ret = [];

			for (var i = 0; i < textv2.length; i++) {

				var tmp = {};

				var textv22 =$(textv2[i]) ;

				tmp.name = textv22.find('.name-<?php echo $name ?>').val();

				ret.push(tmp);

			}

			console.log(JSON.stringify(ret));

			$('textarea[name=<?php echo $name ?>]').val(JSON.stringify(ret));

		}

		$(document).on('change','.name-{{$name}}',function(e){

			calculate<?php echo $name ?>();

		});

		$(document).on('click', '.textv2-<?php echo $name ?> .item .delete', function(event) {

			event.preventDefault();

			$(this).parents('.item').remove();

			calculate<?php echo $name ?>();

		});

		$(document).on('click', '.textv2-<?php echo $name ?> .btndelete', function(event) {

			event.preventDefault();

			$(this).parent().parent().children('img').attr('src','admin/images/noimage.png');

			$(this).parent().parent().children('input').val('admin/images/noimage.png');

			calculate<?php echo $name ?>();

			

		});

		$(".add-<?php echo $name ?>").click(function(event) {

			event.preventDefault();

			var str = '<div class="item">'

				+'<div class="row" style="padding-top: 6px;padding-bottom: 6px">'

					+'<div class="col-md-3">'

						+'<label style="padding-left: 10px;">Nội dung</label>'

					+'</div>'

					+'<div class="col-md-9"><div style="padding-right: 10px;">'

						+'<input class="name-<?php echo $name ?>"></input>'

					+'</div></div>'

				+'</div>'

				+'<div class="text-center">'

				+'<button type="button" class="delete" style="margin-bottom: 6px;">Xóa</button>'

				+'</div>'

			+'</div>';

			$('.textv2-<?php echo $name ?>').append(str);

		});

	});

</script>