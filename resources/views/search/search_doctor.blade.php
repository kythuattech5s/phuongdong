@if (count($listItems) > 0)
	<div class="row gx-2 gx-3">
		@foreach ($listItems as $key => $item)
			<div class="col-6 col-lg-3">
		    	@include('doctors.item_same_specialty',['itemDoctor'=>$item])
			</div>
		@endforeach
	</div>
	<div class="pagination d-flex justify-content-center mt-3 wow fadeInUp">
	    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
	</div>
@else
	<p class="no-item">Không tìm thấy bác sĩ nào</p>
@endif