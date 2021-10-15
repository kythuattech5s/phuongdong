<div class="header-menu-wrapper">
	@if (isset($itemFlashNotifcation))
		<div class="flash-notification" style="display: none">
			<div class="container d-flex align-items-center fs-16-cv">
				<div class="content">
					<a href="{{$itemFlashNotifcation->link}}" class="smooth" title="{{$itemFlashNotifcation->name}}">
						<span class=robotob>{{$itemFlashNotifcation->title}}:</span>
						<span>{{$itemFlashNotifcation->name}}</span>
					</a>
				</div>
				<div class="close-icon hv-icon">
					<i class="fa fa-times" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	@endif
	<header class="header">
		<div class="header-top">
			<div class="container position-relative d-flex align-items-center justify-content-between">
				<div class="logo">
					<a href="{{VRoute::get('home')}}" class="smooth" title="{[site_name]}">
						<img src="{Ilogo.imgI}" title="{Ilogo.titleI}" alt="{Ilogo.altI}" class="img-fluid">
					</a>
				</div>
				<div class="search-box">
					<form class="form-search-header form-search-autocomplete" action="{{VRoute::get('search')}}" method="GET" accept-charset="utf8" autocomplete="off">
						<div class="position-relative">
							<input class="fs-16-cv" type="text" name="q" placeholder="Tìm kiếm thông tin, hỏi đáp, bác sĩ...">
							<button class="smooth" type="submit">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
							<div class="auto_complete_result">
								<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
								<div class="text_result">
								</div>
							</div>
						</div>
					</form>
				</div>
				<a href="tel:{[hotline]}" class="phone-header d-none d-lg-flex hv-sp-main align-items-center" title="Hotline">
					<div class="icon d-inline-block">
						<img src="frontend/images/support-phone.png" title="" alt="" class="img-fluid smooth">
					</div>
					<div class="content d-inline-block ps-2">
						<p class="smooth">Hotline</p>
						<p class="phone-number smooth fs-20-cv d-inline-block">{[hotline]}</p>
					</div>
				</a>
				<div class="header-action d-none d-md-flex align-items-center justify-content-between">
					<a href="{{VRoute::get('makeQuestion')}}" class="btn-all btn-all-main me-2" title="Gửi câu hỏi"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Gửi câu hỏi</a>
					<a href="#" data-bs-toggle="modal" data-bs-target="#orderExaminationSchedule" class="btn-all btn-all-sp" title="Đặt lịch khám"><i class="fa fa-commenting-o" aria-hidden="true"></i> Đặt lịch khám</a>
				</div>
				<div class="d-flex d-xl-none align-items-center ms-2">
					<button class="btn-show-search-form me-3">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
					<button class="btn-lang btn-lang-en me-3" onclick="backToDefaultLanguage()">
						<img src="frontend/images/lang_en.png" title="Tiếng anh" alt="Tiếng anh" class="img-fluid smooth">
					</button>
					<button class="btn-lang btn-lang-vi me-3" onclick="doGTranslate('en|vi');return false;">
						<img src="frontend/images/lang_vi.png" title="Tiếng việt" alt="Tiếng việt" class="img-fluid smooth">
					</button>
					<button class="d-flex justify-content-center align-items-center cspoint btn-menu-mobile" type="button">
						<div class="animated-icon"><span></span><span></span><span></span></div>
					</button>
				</div>
			</div>
			<div class="menu-mobile">
			
			</div>
		</div>
		<div class="header-menu-link d-none d-xl-block">
			<div class="position-relative">
				<div class="container d-flex align-items-center justify-content-between position-relative">
					<nav class="main-menu d-none d-md-inline-block">
						@php
							$menu = Support::getMenuRecursive(1);
						@endphp
						{{Support::showMenuRecursive($menu)}}
					</nav>
					<button class="btn-lang btn-lang-en" onclick="backToDefaultLanguage()">
						<img src="frontend/images/lang_en.png" title="Tiếng anh" alt="Tiếng anh" class="img-fluid smooth">
					</button>
					<button class="btn-lang btn-lang-vi" onclick="doGTranslate('en|vi');return false;">
						<img src="frontend/images/lang_vi.png" title="Tiếng việt" alt="Tiếng việt" class="img-fluid smooth">
					</button>
					<button class="d-flex align-items-center btn-sp-menu cspoint" type="button">
						<span class="me-2">Tất cả</span>
						<div class="animated-icon"><span></span><span></span><span></span></div>
					</button>
				</div>
				<div class="all-link-menu">
					<div class="container">
						<div class="d-flex justify-content-between align-items-center header-all-link">
							<p class="fs-18 robotob text-uppercase">Tất cả chuyên mục</p>
							<button class="btn-close-all-link d-flex align-items-center clmain hv-icon">
								<span class="me-2">Đóng</span>
								<i class="fa fa-times fs-20" aria-hidden="true"></i>
							</button>
						</div>
						@php
							$menu = Support::getMenuSitemapRecursive();
						@endphp
						{{Support::showMenuRecursive($menu)}}
					</div>
				</div>
			</div>
		</div>
	</header>
</div>
<div class="modal fade" id="orderExaminationSchedule" tabindex="-1"  aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body p-0">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
				@include('static.form_order_examination_schedule',['datepick_2'=>2])
			</div>
		</div>
	</div>
</div>
<div class="container">
	@include('banner_gdn.banner_gdn_header')
</div>