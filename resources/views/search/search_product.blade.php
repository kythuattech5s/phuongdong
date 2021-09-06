@if (count($listItems) > 0)
	<div class="row">
        @foreach ($listItems as $key => $item)
	    	<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-6 mb-20">
	            @include('products.item_product')
	    	</div>
        @endforeach
	</div>
	<div class="pagination justify-content-start wow fadeInUp">
	    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
	</div>
@else
	<p class="no-item">Không tìm thấy dụng cụ học tập nào</p>
@endif