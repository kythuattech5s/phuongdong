<?php 
	$name = FCHelper::er($table,'name');
	$value ="";
	if($actionType=='edit'||$actionType=='copy'){
		$value = FCHelper::er($dataItem,$name);
	}
?>
<style type="text/css">
	.ace_editor {
	    margin: 0;
	    position: relative;
	    top: 0;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    min-height: 435px;
	    max-height: 800px;
	    border: 1px solid #ddd;
	    margin-bottom: 10px;
	}
</style>
<div class="form-group">
  	<p class="form-title" for="">{{FCHelper::er($table,'note')}}<span class="count"></span></p>
 	<textarea style="display: none" {{FCHelper::ep($table,'require')==1?'required':''}} name="{{$name}}" placeholder="{{FCHelper::ep($table,'note')}}" dt-type="{{FCHelper::ep($table,'type_show')}}" class="form-control" rows="2">{{$value}}</textarea>
 	<div id="ace_editor_{{$name}}" class="ace-editor"></div>
</div>
<script type="text/javascript">
	$(document).ready(function($) {
		var ace_editor_{{$name}} = ace.edit("ace_editor_{{$name}}");
	    ace_editor_{{$name}}.getSession().setMode("ace/mode/html");
	    ace_editor_{{$name}}.setTheme("ace/theme/monokai");
	    ace_editor_{{$name}}.setValue($('textarea[name={{$name}}]').val());
	    ace_editor_{{$name}}.getSession().on('change', function() {
			$('textarea[name={{$name}}]').val(ace_editor_{{$name}}.getSession().getValue());
		});
	});
</script>