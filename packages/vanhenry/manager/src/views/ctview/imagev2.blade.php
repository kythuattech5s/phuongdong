<?php

$img = 'admin/images/noimage.png';

$value = FCHelper::ep($dataItem,$show->name);

$tmp = json_decode($value,true);

$img = isset($tmp) && is_array($tmp) && array_key_exists("path", $tmp)  ? $tmp["path"].$tmp["file_name"]:$img; 

?>

<td data-title="{{$show->note}}">

	<img src="{{$img}}" style="max-width: 50px;max-height: 30px;margin: 2px auto;" class="img-responsive">

</td>