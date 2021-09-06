@if (count($listItems) > 0)
	@foreach ($listItems as $key => $item)
	    @include('news.item')
	@endforeach
	<div class="pagination">
	    {{$listItems->withQueryString()->links('vendor.pagination.pagination')}}
	</div>
@else
	<p class="no-item">Không tìm thấy tin tức nào</p>
@endif