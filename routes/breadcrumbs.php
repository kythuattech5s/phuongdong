<?php
Breadcrumbs::for('home', function ($trail) {
	$trail->push('Trang chủ', VRoute::get('home'));
});
Breadcrumbs::for('static', function ($trail,$name,$slug) {
	$trail->push('Trang chủ', VRoute::get('home'));
	$trail->push($name,$slug);
});
Breadcrumbs::for('specialists', function ($trail,$currentItem) {
	$trail->push('Trang chủ', VRoute::get('home'));
	$trail->push('Chuyên khoa', VRoute::get('chuyen-khoa'));
	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('all-doctors-sub', function ($trail,$specialists) {
	$trail->push('Trang chủ', VRoute::get('home'));
	$trail->push('Đội ngũ bác sĩ', VRoute::get('doi-ngu-bac-si'));
	$trail->push($specialists->name, \Support::show($specialists, 'slug'));
});
Breadcrumbs::for('doctors', function ($trail,$currentItem,$specialists) {
	$trail->push('Trang chủ', VRoute::get('home'));
	$trail->push('Đội ngũ bác sĩ', VRoute::get('doi-ngu-bac-si'));
	if (isset($specialists)) {
		$trail->push($specialists->name, \Support::show($specialists, 'slug'));
	}
	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('page', function ($trail,$currentItem) {
	$trail->parent('home');
	$trail->push($currentItem->name);
});
Breadcrumbs::for('specialist_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		$trail->push('Chuyên khoa', VRoute::get('chuyen-khoa'));
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\SpecialistCategory::where('specialist_category.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('specialist_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('news_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		// if ($currentItem->type_slug == 2) {
		// 	$trail->push('Hướng dẫn khách hàng', VRoute::get('huong-dan-khach-hang'));
		// }else {
		// 	$trail->push('Tin tức', VRoute::get('tin-tuc'));
		// }
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\NewsCategory::where('news_categories.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('news_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('news', function ($trail, $currentItem, $parent) {
    if ($parent == null) {
		$trail->parent('home');
   		$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
    else{
    	$trail->parent('news_category', $parent);
    	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
});
Breadcrumbs::for('service_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		$trail->push('Dịch vụ',VRoute::get('dich-vu'));
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\ServiceCategory::where('service_category.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('service_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('services', function ($trail, $currentItem, $parent) {
    if ($parent == null) {
		$trail->parent('home');
   		$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
    else{
    	$trail->parent('service_category', $parent);
    	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
});
Breadcrumbs::for('question_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		$trail->push('Hỏi đáp chuyên gia',VRoute::get('hoi-dap-chuyen-gia'));
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\QuestionCategory::where('question_category.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('question_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('question', function ($trail, $currentItem, $parent) {
    if ($parent == null) {
		$trail->parent('home');
   		$trail->push('Hỏi đáp chuyên gia',VRoute::get('hoi-dap-chuyen-gia'));
   		$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
    else{
    	$trail->parent('question_category', $parent);
    	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
});
Breadcrumbs::for('image_gallery_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		$trail->push('Thư viện ảnh',VRoute::get('thu-vien-anh'));
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\ImageGalleryCategory::where('image_gallery_categories.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('image_gallery_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('image_gallery', function ($trail, $currentItem, $parent) {
    if ($parent == null) {
		$trail->parent('home');
   		$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
    else{
    	$trail->parent('image_gallery_category', $parent);
    	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
});
Breadcrumbs::for('video_gallery_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		$trail->push('Thư viện video',VRoute::get('thu-vien-video'));
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\ImageGalleryCategory::where('video_gallery_categories.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('video_gallery_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('video_gallery', function ($trail, $currentItem, $parent) {
    if ($parent == null) {
		$trail->parent('home');
   		$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
    else{
    	$trail->parent('video_gallery_category', $parent);
    	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
});
Breadcrumbs::for('file_gallery_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
		$trail->push('Thư viện file',VRoute::get('thu-vien-file'));
	}
	if ($currentItem->parent > 0) {
		$parent = App\Models\ImageGalleryCategory::where('file_gallery_categories.id', $currentItem->parent)->first();
	    if ($parent != null) {
    		$trail->parent('file_gallery_category', $parent, $level += 1);
	    }	
	}
    $trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('file_gallery', function ($trail, $currentItem, $parent) {
    if ($parent == null) {
		$trail->parent('home');
   		$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
    else{
    	$trail->parent('file_gallery_category', $parent);
    	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
    }
});
Breadcrumbs::for('drug_lookups', function ($trail, $currentItem) {
	$trail->parent('home');
	$trail->push('Tra cứu thuốc', VRoute::get('tra-cuu-thuoc'));
	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('body_lookups', function ($trail, $currentItem) {
	$trail->parent('home');
	$trail->push('Tra cứu cơ thể', VRoute::get('tra-cuu-co-the'));
	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('disease_lookups', function ($trail, $currentItem) {
	$trail->parent('home');
	$trail->push('Tra cứu bệnh', VRoute::get('tra-cuu-benh'));
	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('news_tag', function ($trail, $currentItem) {
	$trail->parent('home');
	$trail->push($currentItem->name);
});