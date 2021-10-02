@if (count($listItems) > 0)
	<p class="all-title-detail mt-3 robotob wow fadeInUp">Tin tức</p>
	<div class="row gx-2 gx-3">
		@foreach ($listItems as $key => $item)
			<div class="col-6 col-md-12 col-lg-6">
		    	@include('news.item')
			</div>
		@endforeach
	</div>
	<div class="pagenigation d-flex justify-content-center mt-3 wow fadeInUp">
	    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
	</div>
@endif