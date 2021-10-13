<picture>
	<source media="(min-width:0px)" data-srcset="{%IMGV2.itemImage.img.350x0%}" srcset="{%IMGV2.itemImage.img.350x0%}">
	<img {{isset($noLazyLoad) && $noLazyLoad == 1 ? '':'loading="lazy"'}} src="{%IMGV2.itemImage.img.350x0%}" data-src="{%IMGV2.itemImage.img.350x0%}" title="{%AIMGV2.itemImage.img.title%}" alt="{%AIMGV2.itemImage.img.alt%}" class="img-fluid">
</picture>