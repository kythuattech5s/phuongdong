@if (count($listItems) > 0)
	<p class="all-title-detail my-3 robotob wow fadeInUp">Dịch vụ</p>
	<div class="row gx-2 gx-3">
		@foreach ($listItems as $key => $item)
			<div class="col-6 col-lg-4 mb-2 mb-lg-3">
		    	@include('services.item')
			</div>
		@endforeach
	</div>
	<div class="pagenigation d-flex justify-content-center mt-3 wow fadeInUp">
	    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
	</div>
@endif