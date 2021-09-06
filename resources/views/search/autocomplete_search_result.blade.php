@if (count($listNews) > 0)
	<p class="title-result">Tin tức</p>
	@foreach ($listNews as $itemNews)
		<div class="item-auto-result align-items-start d-flex">
			<div class="img">
				<a href="{{Support::Show($itemNews,'slug')}}" class="smooth" title="{{Support::Show($itemNews,'name')}}">
					<img src="{%IMGV2.itemNews.img.-1%}" alt="{%AIMGV2.itemNews.img.alt%}">
				</a>
			</div>
			<div class="content">
				<p class="name robotob fs-16"><a href="{{Support::Show($itemNews,'slug')}}" class="smooth hv-sp" title="{{Support::Show($itemNews,'name')}}">{{Support::Show($itemNews,'name')}}</a></p>
				<div class="text-right mt-2">
					<small>{{Support::Show($itemNews,'created_at')}}</small>
				</div>
			</div>
		</div>
	@endforeach
@endif
@if (count($listServices) > 0)
	<p class="title-result">Dịch vụ</p>
	@foreach ($listServices as $itemServices)
		<div class="item-auto-result align-items-start d-flex">
			<div class="img">
				<a href="{{Support::Show($itemServices,'slug')}}" class="smooth" title="{{Support::Show($itemServices,'name')}}">
					<img src="{%IMGV2.itemServices.img.-1%}" alt="{%AIMGV2.itemServices.img.alt%}">
				</a>
			</div>
			<div class="content">
				<p class="name robotob fs-16"><a href="{{Support::Show($itemServices,'slug')}}" class="smooth hv-sp" title="{{Support::Show($itemServices,'name')}}">{{Support::Show($itemServices,'name')}}</a></p>
				<div class="text-right mt-2">
					<small>{{Support::Show($itemServices,'created_at')}}</small>
				</div>
			</div>
		</div>
	@endforeach
@endif
@if (count($listSpecialist) > 0)
	<p class="title-result">Chuyên khoa</p>
	@foreach ($listSpecialist as $itemSpecialist)
		<div class="item-auto-result align-items-start d-flex">
			<div class="img">
				<a href="{{Support::Show($itemSpecialist,'slug')}}" class="smooth" title="{{Support::Show($itemSpecialist,'name')}}">
					<img src="{%IMGV2.itemSpecialist.img.-1%}" alt="{%AIMGV2.itemSpecialist.img.alt%}">
				</a>
			</div>
			<div class="content">
				<p class="name robotob fs-16"><a href="{{Support::Show($itemSpecialist,'slug')}}" class="smooth hv-sp" title="{{Support::Show($itemSpecialist,'name')}}">{{Support::Show($itemSpecialist,'name')}}</a></p>
				<div class="text-right mt-2">
					<small>{{Support::Show($itemSpecialist,'created_at')}}</small>
				</div>
			</div>
		</div>
	@endforeach
@endif
@if (count($listDoctor) > 0)
	<p class="title-result">Bác sĩ</p>
	@foreach ($listDoctor as $itemDoctor)
		<div class="item-auto-result align-items-start d-flex">
			<div class="img">
				<div class="img-doctor">
					<a href="{{Support::Show($itemDoctor,'slug')}}" class="smooth" title="{{Support::Show($itemDoctor,'name')}}">
						<img src="{%IMGV2.itemDoctor.img.-1%}" alt="{%AIMGV2.itemDoctor.img.alt%}">
					</a>
				</div>
			</div>
			<div class="content">
				<p class="name robotob fs-16"><a href="{{Support::Show($itemDoctor,'slug')}}" class="smooth hv-sp" title="{{Support::Show($itemDoctor,'name')}}">{{$itemDoctor->academic_rank}} {{Support::Show($itemDoctor,'name')}}</a></p>
				<p class="my-1">{{$itemDoctor->position}}</p>
				<div class="text-right">
					<small>{{Support::Show($itemDoctor,'created_at')}}</small>
				</div>
			</div>
		</div>
	@endforeach
@endif
@if (count($listNews) == 0 && count($listServices) == 0 && count($listSpecialist) == 0 && count($listDoctor) == 0)
	<p class="text-center py-2">Không có kết quả nào được tìm thấy</p>
@else
	<a href="{{VRoute::get('search')}}?q={{$val}}" class="smooth view-all d-block" title="Xem tất cả kết quả">Xem tất cả kết quả</a>
@endif