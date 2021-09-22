<?php 
	$name = FCHelper::er($table,'name');
	$default_code = FCHelper::er($table,'default_code');
	$default_code = json_decode($default_code,true);
	$default_code = @$default_code?$default_code:array();
	$value ="";
	if($actionType=='edit'||$actionType=='copy'){
		if($name != 'price' && $name != 'price_sale')
		$value = FCHelper::er($dataItem,$name);
		else
		$value = $dataItem->$name;
	}
	$jsons = json_decode($value,true); $jsons = @$jsons?$jsons:[]; 
?>
	<div class="form-group" @if($tableMap=='orders' && $name=='val_order') style="display: none;" @endif>
		<p class="form-title" for="">{{FCHelper::er($table,'note')}} <span class="count"></span></p>
		<textarea class="hidden" name="{{$name}}"><?php echo $value;  ?></textarea>
		<div class="textv2-{{$name}}">
			@foreach($jsons as $key => $json)
			<div class="item">
				<div class="row">
					<div class="col-md-3">
					<label>Tiêu đề</label>
					</div>
					<div class="col-md-9">
						<input class="name-{{$name}}" value="{{isset($json['name'])?$json['name'] :''}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Nội dung</label>
					</div>
					<div class="col-md-9">
						<input class="content-{{$name}}" value="{{isset($json['content'])?$json['content'] :''}}">
					</div>
				</div>
				<div class="text-right">
					<button type="button" class="delete btn_">Xóa</button>
				</div>
			</div>
			@endforeach
		</div>
		<div class="text-center" style="width: 100%;">
			<button type="button" class="add-{{$name}}">Thêm</button>
		</div>
	</div>
	<style type="text/css">
		.textv2-<?php echo $name; ?>{
		    border: 1px solid #00923f;
			width: 100%;
			margin: 10px 0px;
		}
		.textv2-<?php echo $name; ?> .item{
			margin: 10px;
    		border: 1px solid #ccc;
    		padding: 10px;
    		position: relative;
		}
		.textv2-<?php echo $name; ?> .item input, .textv2-<?php echo $name; ?> .item textarea{
			width: 100% !important; 
			padding: 5px;
    		border: 1px solid #00923f;
    		padding-right: 50px;
    		padding-left: 15px;
		}
		.textv2-<?php echo $name; ?> .btn_{
			background: #fff;
			padding: 5px;
			border: 1px solid #00923f;
			position: absolute;
		    top: 10px;
		    right: 10px;
		}
	</style>
	<script type="text/javascript">
		$(function() {
			loadEditor();
			function loadEditor(){
				$('.content-{{$name}}').tinymce({
			        height: 100,
			        theme: 'modern',
			        menubar:'',
			        plugins: [
			          'code advlist autolink lists link paste textcolor colorpicker',
			        ],
			        toolbar1:"code bold italic underline hr strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontsizeselect | link unlink anchor table | forecolor backcolor pastetext",
			        document_base_url:'{{asset('/')}}',
			        image_advtab: true,
			        external_filemanager_path:'{{asset('/').$admincp}}'+'/media/view',
			        filemanager_title:"File Manager" ,
			        external_plugins: { "filemanager" : '{{asset('/')}}'+"public/admin/plug/tinymce/plugins/tech5sfilemanager/plugin.min.js"},
			        setup: function (editor) {
			            editor.on('change', function () {
			                editor.save();
			                calculate<?php echo $name; ?>();
			            });
			        }
			    });
			}
			function calculate<?php echo $name; ?>(){
				var textv2 = $(".textv2-<?php echo $name; ?> .item");
				var ret = [];
				for (var i = 0; i < textv2.length; i++) {
					var tmp = {};
					var textv22 =$(textv2[i]) ;
					// var img = textv22.find(".ti_img");
					tmp.content = textv22.find('.content-<?php echo $name; ?>').val();
					tmp.name = textv22.find('.name-<?php echo $name; ?>').val();
					// try{
					// 	var json = JSON.parse(img.val());
					// 	tmp.img = json.path +json.file_name;
					// }
					// catch(e){
					// 	tmp.img = img.val();
					// }
					ret.push(tmp);	
				}
				$('textarea[name=<?php echo $name; ?>]').val(JSON.stringify(ret));
			}
			$(document).on('input', '.title-<?php echo $name; ?>,.content-<?php echo $name; ?>,.name-<?php echo $name; ?>', function(event) {
				event.preventDefault();
				calculate<?php echo $name; ?>();
			});
			$(document).on('input', '.textv2-{{$name}} .item .ti_img', function(event) {
				event.preventDefault();
				calculate{{$name}}();
			});
			$(document).on('click', '.textv2-<?php echo $name; ?> .item .delete', function(event) {
				event.preventDefault();
				$(this).parents('.item').remove();
				calculate<?php echo $name; ?>();
			});
			$(document).on('click', '.textv2-<?php echo $name; ?> .btndelete', function(event) {
				event.preventDefault();
				$(this).parent().parent().children('img').attr('src','theme/admin/images/noimage.png');
				$(this).parent().parent().children('input').val('theme/admin/images/noimage.png');
				calculate<?php echo $name; ?>();
				
			});
			
			$(".add-<?php echo $name; ?>").click(function(event) {
				event.preventDefault();
				var name = Math.random().toString(36).substring(7);
				var idxti = 'idxti<?php echo $name; ?>'+$(".textv2-{{$name}} .item").length;
				console.log(idxti);
				var str = '<div class="item">'
					+'<div class="row">'
						+'<div class="col-md-3">'
						+'<label>Tiêu đề</label>'
						+'</div>'
						+'<div class="col-md-9">'
						+'<input class="name-<?php echo $name ?>"/>'
						+'</div>'
					+'</div>'
					+'<div class="row">'
						+'<div class="col-md-3">'
						+'<label>Nội dung</label>'
						+'</div>'
						+'<div class="col-md-9">'
						+'<textarea class="content-<?php echo $name ?>"></textarea>'
						+'</div>'
					+'</div>'
					
					+'<div class="text-right">'
					+'<button type="button" class="delete btn_">Xóa</button>'
					+'</div>'
				+'</div>';
				$('.textv2-<?php echo $name ?>').append(str);
				loadEditor();
			});
			
		});
	</script>