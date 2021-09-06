@if (count($courses) > 0)
	<div class="row row__">
	    @foreach($courses as $item)
	    <div class="col col-6 col-sm-6 col-md-4 col-lg-3 mb-20">
	        @include('courses.item')
	    </div>
	    @endforeach
	    <div class="pagination">
	        {{$courses->withQueryString()->links('vendor.pagination.pagination')}}
	    </div>
	</div>
@else
	<p class="no-item">Không tìm thấy khóa học nào</p>
@endif
