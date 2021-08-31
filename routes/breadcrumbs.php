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
	$trail->push($specialists->name, \Support::show($specialists, 'slug'));
	$trail->push($currentItem->name, \Support::show($currentItem, 'slug'));
});
Breadcrumbs::for('page', function ($trail,$currentItem) {
	$trail->parent('home');
	$trail->push($currentItem->name);
});
Breadcrumbs::for('news_category', function ($trail, $currentItem, $level = 0) {
	if ($level == 0) {
		$trail->parent('home');
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
Breadcrumbs::for('news_tag', function ($trail, $currentItem) {
	$trail->parent('home');
	$trail->push($currentItem->name);
});