@if(count($galleryItem) > 0)
<div class="swiper-container mx-auto slide_detail_editor slide_detail_editor_{{$code}}" data-code="{{$code}}">
	<div class="swiper-wrapper">
		@foreach($galleryItem as $item)
			<?php
				$obj = new \stdClass;
				$obj->img = json_encode($item);
			?>
			<div class="swiper-slide">
				<a href="{%IMGV2.obj.img.-1%}" data-fancybox="gallery" class="image d-block">
	                <img src="{%IMGV2.obj.img.-1%}" alt="{%AIMGV2.obj.img.alt%}" title="{%AIMGV2.obj.img.title%}">
	            </a>
			</div>
		@endforeach
	</div>
	<div class="slider-controls">
	    <button class="prev-btn btn-circle__all btn-circle__next slide_detail_editor_prev_{{$code}}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
	    </button>
	    <button class="next-btn btn-circle__all btn-circle__prev slide_detail_editor_next_{{$code}}">
	    	<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</button>
	</div>
</div>
@endif