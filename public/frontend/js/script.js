function updateTextInputFontsize(val){
	$('.current-fontsize').html(val);
	$('.new-content-main').css('fontSize',val+'px');
}
jQuery.fn.highlight = function(pat) {
    function innerHighlight(node, pat) {
        var skip = 0;
        if (node.nodeType == 3) {
            var pos = node.data.toUpperCase().indexOf(pat);
            pos -= (node.data.substr(0, pos).toUpperCase().length - node.data.substr(0, pos).length);
            if (pos >= 0) {
                var spannode = document.createElement('span');
                spannode.className = 'highlight';
                var middlebit = node.splitText(pos);
                var endbit = middlebit.splitText(pat.length);
                var middleclone = middlebit.cloneNode(true);
                spannode.appendChild(middleclone);
                middlebit.parentNode.replaceChild(spannode, middlebit);
                skip = 1;
            }
        }
        else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
            for (var i = 0; i < node.childNodes.length; ++i) {
                i += innerHighlight(node.childNodes[i], pat);
            }
        }
        return skip;
    }
    return this.length && pat && pat.length ? this.each(function() {
        innerHighlight(this, pat.toUpperCase());
    }) : this;
};
jQuery.fn.removeHighlight = function() {
    return this.find("span.highlight").each(function() {
        this.parentNode.firstChild.nodeName;
        with (this.parentNode) {
            replaceChild(this.firstChild, this);
            normalize();
        }
    }).end();
};
var SEARCH = (function(){
    var autoclose= function(){
        $(window).click(function(e){
            if($('.form-search-autocomplete').has(e.target).length == 0 && !$('.top_search').is(e.target) && $('.auto_complete_result').has(e.target).length == 0 && !$('.auto_complete_result').is(e.target)){
                $('.auto_complete_result').css({"display":"none"});
            }
        });
    };
    var autoComplete =function(){
        var getAuto = null;
        $(document).on('input', ".form-search-autocomplete input", function (){
            var val = $(this).val();
            clearTimeout(getAuto);
            var rong = '';
            $('.auto_complete_result .text_result').html(rong);
            if (val != '') {
                $('.auto_complete_result .lds-spinner').css('display','block');
                $('.auto_complete_result').css('display','block');
            }
            var _this = $(this);
            getAuto = setTimeout(function(){ 
                if (val == "") {
                    $('.auto_complete_result').css({"display":"none"});
                }else {
                	if (val.length < 3) {
                		$('.auto_complete_result .lds-spinner').css('display','none');
	                    $('.auto_complete_result .text_result').html('<p class="text-center py-2">Vui lòng nhập từ khóa it nhất 3 kí tự</p>');
                	}else {
                		$.ajax({
	                        url: _this.closest('.form-search-autocomplete').attr('action'),
	                        type: 'POST',
	                        global: false,
	                        data: {val: val},
	                    })
	                    .done(function(data) {
	                        $('.auto_complete_result .lds-spinner').css('display','none');
	                        $('.auto_complete_result .text_result').html(data);
	                        if (val.trim().length > 1 ) {
	                            var arrKeys = val.split(" ");
	                            for (var i = arrKeys.length - 1; i >= 0; i--) {
	                                $('.auto_complete_result .text_result').highlight(arrKeys[i]);
	                            }
	                        }
	                    })	
                	}
                };
            },300);
        })
    }
    return {_:function(){
        autoclose();
        autoComplete();
    }
};
})();
var GUI = (function(){
	var initWow = function() {
		if ($(window).width() > 575) {
			var wow = new WOW();
			wow.init();
		}
	}
	var initNumberUp = function(){
        if($('.list_count_top').length > 0) {
            var capacityStatus=0;
            var win = $(window);
            var heiwin = win.height();
            win.scroll(function() {  
                if(capacityStatus==0 && win.scrollTop() > ($('.list_count_top').offset().top) - heiwin){
                    if($('.item_count').length>0){
                        $('.item_count').each(function () {
                            $(this).prop('Counter',0).animate({
                                Counter: $(this).text().replace(/\D/g, '').replace(/ /g,'')
                            }, {
                                duration: 3000,
                                easing: 'swing',
                                step: function (now) {
                                    $(this).text(Math.ceil(now));
                                }
                            });
                        });
                    }
                    capacityStatus=1; 
                }
            });
        }
    }
 	var flashNotification = function(){
 		$('.flash-notification .close-icon').click(function(event) {
 			$(this).closest('.flash-notification').slideUp(300);
 			sessionStorage.setItem('read_notification', 1);
 		});
	}
	var initMenuChild = function(){
		$('.main-menu li').each(function(index, el) {
			if ($(this).find('> ul').length > 0) {
				$(this).find('> a').addClass('have-child');
			}
		});
	}
	var bindDatePickerMedical = function() {
		var datetimepicker = $("#datepicker-medical").datepicker({ 
        	autoclose: true, 
        	todayHighlight: true,
        	format:'d/m/yyyy',
        	language: 'vi'
  		}).datepicker('update', new Date()).on('changeDate', function(ev) {
		    $(ev.currentTarget).closest('form').find('.list-time-pick').slideDown(300);
		});
  		$('#datepicker-medical input').val('');

  		var datetimepicker2 = $("#datepicker-medical2").datepicker({ 
        	autoclose: true, 
        	todayHighlight: true,
        	format:'d/m/yyyy',
        	language: 'vi'
  		}).datepicker('update', new Date()).on('changeDate', function(ev) {
		    $(ev.currentTarget).closest('form').find('.list-time-pick').slideDown(300);
		});
  		$('#datepicker-medical2 input').val('');
	}
	var initSearch = function(argument) {
		$('.btn-show-search-form').click(function(event) {
			$('.header-top .form-search-header').toggleClass('active');
		});
		$(window).click(function(e){
			if($('.btn-show-search-form').has(e.target).length == 0 && !$('.btn-show-search-form').is(e.target) && $('.header-top .form-search-header').has(e.target).length == 0 && !$('.header-top .form-search-header').is(e.target)){
				$('.header-top .form-search-header').removeClass('active');
			}
		});
	}
	var initMenuShow = function() {
		var htmlMenu = $('.main-menu').html();
		$('.menu-mobile').append(htmlMenu);
		$('.btn-sp-menu').click(function(event) {
			$(this).find('.animated-icon').toggleClass('open');
			if ($(this).find('.animated-icon').hasClass('open')) {
				$('.all-link-menu').slideDown(300);
			}else {
				$('.all-link-menu').slideUp(300);
			}
		});
		$('.btn-close-all-link').click(function(event) {
			$('.btn-sp-menu .animated-icon').removeClass('open');
			$('.all-link-menu').slideUp(300);
		});
		$('.btn-menu-mobile').click(function(event) {
			$(this).find('.animated-icon').toggleClass('open');
			if ($(this).find('.animated-icon').hasClass('open')) {
				$('.menu-mobile').slideDown(300);
			}else {
				$('.menu-mobile').slideUp(300);
			}
		});
		$('.menu-mobile').find("ul li").each(function() {
			if($(this).find("ul>li").length > 0){
				$(this).append('<i class="fa fa-angle-right smooth btn-drop-menu" aria-hidden="true"></i>');
			}
		});
		$('.btn-drop-menu').click(function(){
			if( $($(this).parent('li').children('ul')).is(':hidden')===true){
				$(this).addClass('rotate');
				$(this).parent('li').children('ul').slideDown(300);
			}
			else{
				$(this).removeClass('rotate');
				$(this).parent('li').children('ul').slideUp(300);
			};
		});
	}
	var backToTop = function(){
		if($(".back-to-top").length > 0){
			$(window).scroll(function () {
				var e = $(window).scrollTop();
				if (e > 300) {
					$(".back-to-top").show();
				} else {
					$(".back-to-top").hide();
				}
			});
			$(".back-to-top").click(function () {
				$('body,html').animate({
					scrollTop: 0
				},500)
			})
		} 
	}
	var scrollIntoViewNew = function () {
        if ($(".toc_list").length == 0) return;
        $(document).on("click", '.toc_list a[href^="#"]', function (e) {
            e.preventDefault();
            var id = $(this).attr("href");
            var $id = $(id);
            if ($id.length === 0) {
                return;
            }
            var pos = $id.offset().top;
            $("body, html").animate({ scrollTop: pos }, 400);
        });
        $(document).on('click', '.toggle-content-toc', function(event) {
        	event.preventDefault();
        	$(this).toggleClass('active');
        	var tocList = $(this).closest('#toc_container').find('.toc_list');
        	if ($(this).hasClass('active')) {
        		tocList.slideDown(300);
        	}else {
        		tocList.slideUp(300);
        	}
        });
    }
    var showActiveCharacter = function () {
    	$(document).on('click', '.list-character .item-character', function(event) {
    		event.preventDefault();
    		$('.list-character .item-character').not(this).removeClass('active');
    		$(this).toggleClass('active');
    		var idKey = $(this).data('key');
    		if ($(this).hasClass('active')) {
    			$('.section-item-search').not($('#'+idKey)).addClass('d-none');
    			$('#'+idKey).removeClass('d-none');
    		}else {
    			$('.section-item-search').removeClass('d-none');
    		}
    	});
    	$(document).on('click', '.section-item-search .back-first-page', function(event) {
    		event.preventDefault();
    		$('.section-item-search').removeClass('d-none');
    		$('.list-character .item-character')	.removeClass('active');
    	});
    }
    var showQuickNotification =  function () {
    	if ($('.flash-notification').length > 0) {
    		let check = parseInt(sessionStorage.getItem('read_notification'));
    		if (check !== 1) {
	    		setTimeout(function(){
	    			$('.flash-notification').slideDown(500);
	    		}, 1500);
    		}
    	}
    }
    var showChangeFontSizeUser = function (){
    	$('.btn-show-change-fontsize').click(function(event) {
    		event.preventDefault();
    		$(this).toggleClass('active');
    		if ($(this).hasClass('active')) {
    			$('.show-change-font-size').slideDown(300);
    		}else {
    			$('.show-change-font-size').slideUp(300);
    		}
    	});
    	$(window).click(function(e){
            if($('.btn-show-change-fontsize').has(e.target).length == 0 && !$('.btn-show-change-fontsize').is(e.target) && $('.show-change-font-size').has(e.target).length == 0 && !$('.show-change-font-size').is(e.target)){
                $('.show-change-font-size').slideUp(300);
            }
        });
    }
	return {
		_:function(){
			flashNotification();
			initMenuChild();
			bindDatePickerMedical();
			initWow();
			initSearch();
			initMenuShow();
			backToTop();
			scrollIntoViewNew();
			showActiveCharacter();
			showQuickNotification();
			showChangeFontSizeUser();
			initNumberUp();
		}
	};
})();
var SLIDER = (function(){
 	var sliderBannerHome = function(){
		if ($('.slide-banner-home').length == 0) return;
		const swiper = new Swiper('.slide-banner-home', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 1000,
			effect: "coverflow",
			navigation: {
				nextEl: ".slide-banner-home-next",
				prevEl: ".slide-banner-home-prev",
			},
			pagination: {
				el: ".pagination-banner-home",
				clickable: true,
			},
		});
	}
	var sliderOurService = function(){
		if ($('.slide-our-service').length == 0) return;
		const swiper = new Swiper('.slide-our-service', {
			slidesPerView: 1.2,
			loop: false,
			disableOnInteraction: true,
			speed:600,
			pagination: {
				el: ".pagination-our-service",
				clickable: true,
			},
			spaceBetween: 20,
			breakpoints: {
				768: {
					slidesPerView: 2,
				},
				991: {
					slidesPerView: 3,
				},
			},
		});
	}
	var slideExpertTeam = function(){
		if ($('.slide-expert-team-thumb').length == 0) return;
		const swiperThumb = new Swiper('.slide-expert-team-thumb', {
			slidesPerView: 2.8,
			speed: 1000,
			freeMode: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			spaceBetween: 15,
			breakpoints: {
				768: {
					slidesPerView: 4.5,
					spaceBetween: 20
				},
				991: {
					slidesPerView: 5,
					spaceBetween: 30
				},
				1200: {
					slidesPerView: 6,
					spaceBetween: 45
				}
			}
		});
		if ($('.slide-expert-team').length == 0) return;
		const swiper = new Swiper('.slide-expert-team', {
			slidesPerView: 1,
			loop: false,
			fadeEffect: { crossFade: true },
  			virtualTranslate: true,
			speed: 600,
			effect: "fade",
			thumbs: {
				swiper: swiperThumb,
			},
			navigation: {
				nextEl: ".slide-expert-team-next",
				prevEl: ".slide-expert-team-prev"
			}
		});
	}
	var sliderPartner = function(){
		if ($('.slide-partner').length == 0) return;
		const swiperThumb = new Swiper('.slide-partner', {
			slidesPerView: 2.8,
			loop: false,
			disableOnInteraction: true,
			speed:600,
			freeMode: true,
			pagination: {
				el: ".pagination-partner-home",
				clickable: true,
			},
			spaceBetween: 15,
			breakpoints: {
				768: {
					slidesPerView: 4,
					spaceBetween: 20
				},
				991: {
					slidesPerView: 6,
					spaceBetween: 20
				},
				1200: {
					slidesPerView: 7,
				}
			}
		});
	}
	var sliderPathology = function(){
		if ($('.slide-pathology').length == 0) return;
		const swiperThumb = new Swiper('.slide-pathology', {
			slidesPerView: 3.8,
			loop: false,
			disableOnInteraction: true,
			speed:600,
			freeMode: true,
			spaceBetween: 10,
			navigation: {
				nextEl: ".slide-pathology-next",
				prevEl: ".slide-pathology-prev"
			},
			breakpoints: {
				768: {
					slidesPerView: 6,
					spaceBetween: 20
				},
				991: {
					slidesPerView: 8,
					spaceBetween: 20
				},
				1200: {
					slidesPerView: 9,
				}
			}
		});
	}
	var sliderHotService = function(){
		if ($('.hot-service-slider').length == 0) return;
		const swiper = new Swiper('.hot-service-slider', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 1000,
			navigation: {
				nextEl: ".slide-hot-service-next",
				prevEl: ".slide-hot-service-prev",
			}
		});
	}
	var sliderDoctorSameSpecialty = function(){
		if ($('.slide-doctor-same-specialty').length == 0) return;
		const swiper = new Swiper('.slide-doctor-same-specialty', {
			slidesPerView: 1.2,
			loop: false,
			disableOnInteraction: true,
			speed:600,
			navigation: {
				nextEl: ".slide-doctor-same-specialty-next",
				prevEl: ".slide-doctor-same-specialty-prev",
			},
			pagination: {
				el: ".pagination-doctor-same-specialty",
				clickable: true,
			},
			spaceBetween: 20,
			breakpoints: {
				768: {
					slidesPerView: 2.3,
				},
				991: {
					slidesPerView: 3,
				},
			},
		});
	}
	var sliderDoctorImage = function(){
		if ($('.slide-doctor-image').length == 0) return;
		const swiper = new Swiper('.slide-doctor-image', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 1000,
			effect: "coverflow",
			navigation: {
				nextEl: ".slide-doctor-image-next",
				prevEl: ".slide-doctor-image-prev",
			}
		});
	}
	var sliderTtbHome = function(){
		if ($('.slide-ttb-home').length == 0) return;
		if ($('.slide-ttb-content-home').length == 0) return;
		const swiperThumb = new Swiper('.slide-ttb-content-home', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 600,
			effect: "coverflow",
		});
		const swiper = new Swiper('.slide-ttb-home', {
			slidesPerView: 1.3,
			speed: 1000,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			spaceBetween: 15,
			pagination: {
				el: ".pagination-ttb-home",
				clickable: true,
			},
			thumbs: {
				swiper: swiperThumb,
			},
			breakpoints: {
				768: {
					slidesPerView: 2.5,
				},
				991: {
					slidesPerView: 1,
					spaceBetween: 0,
					effect: "coverflow"
				}
			}
		});
	}
	var sliderGalley = function(){
		if ($('.slide-galley').length == 0) return;
		const swiper = new Swiper('.slide-galley', {
			slidesPerView: 1.5,
			loop: false,
			disableOnInteraction: true,
			speed:600,
			pagination: {
				el: ".pagination-galley",
				clickable: true,
			},
			spaceBetween: 15,
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 25
				}
			}
		});
	}
	var sliderHotGallery = function(){
		if ($('.slide-hot-galley').length == 0) return;
		const swiper = new Swiper('.slide-hot-galley', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 1000,
			navigation: {
				nextEl: ".slide-hot-galley-next",
				prevEl: ".slide-hot-galley-prev",
			}
		});
	}
	var sliderGreenHospitalModel = function(){
		if ($('.slider-green-hospital-model').length == 0) return;
		const swiper = new Swiper('.slider-green-hospital-model', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 1000,
			effect: "coverflow",
			pagination: {
				el: ".pagination-green-hospital-model",
				clickable: true,
			},
		});
	}
	var sliderIntroTtb = function(){
		if ($('.slide-ttb-intrduce').length == 0) return;
		const swiper = new Swiper('.slide-ttb-intrduce', {
			slidesPerView: 1.5,
			loop: false,
			disableOnInteraction: true,
			speed:600,
			pagination: {
				el: ".pagination-ttb-intrduce",
				clickable: true,
			},
			spaceBetween: 10,
			breakpoints: {
				768: {
					slidesPerView: 2,
				}
			}
		});
	}
	var slideHistoryBegin = function(){
		if ($('.slide-history-begin-thumb').length == 0) return;
		const swiperThumb = new Swiper('.slide-history-begin-thumb', {
			slidesPerView: 2.8,
			speed: 1000,
			freeMode: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			spaceBetween: 0,
			breakpoints: {
				768: {
					slidesPerView: 4.5
				},
				991: {
					slidesPerView: 5
				},
				1200: {
					slidesPerView: 6
				}
			}
		});
		if ($('.slide-history-begin-main').length == 0) return;
		const swiper = new Swiper('.slide-history-begin-main', {
			slidesPerView: 1,
			loop: false,
			disableOnInteraction: true,
			speed: 1000,
			thumbs: {
				swiper: swiperThumb,
			}
		});
	}
	return {
		_:function(){
			sliderBannerHome();
			sliderOurService();
			slideExpertTeam();
			sliderPartner();
			sliderPathology();
			sliderHotService();
			sliderDoctorSameSpecialty();
			sliderDoctorImage();
			sliderTtbHome();
			sliderGalley();
			sliderHotGallery();
			sliderGreenHospitalModel();
			sliderIntroTtb();
			slideHistoryBegin();
		}
	};
})();
var AJAX_SP = (function(){
    var paginateAjax = function(){
        var main_content = $('.module-paginate-ajax');
        if ($('.module-paginate-ajax').length > 0) {
            main_content.each(function(index, el) {
                var _this = $(this);
                $.ajax({
                    url: _this.data('action'),
                    type: 'GET',
                    dataType: 'html',
                    data: {info:_this.data('info')},
                })
                .done(function(data) {
                    _this.html(data);
                })
            });
        }
        $(document).on('click', '.module-paginate-ajax .pagenigation a', function(event) {
            event.preventDefault();
            var resultBox = $(this).closest('.module-paginate-ajax');
            $.ajax({
                url: $(this).attr('href'),
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                resultBox.html(data);
                var offsettop = resultBox.offset().top - 50;
                $('html,body').animate({
                    scrollTop: offsettop
                }, 700);
            })
        });
    }
    var sendContact =  function(){
    	$('.form-send-contact').submit(function(event) {
    		event.preventDefault();
    		var _this = $(this);
		    _this.addClass('in-loading-form');
		    $.ajax({
		    	url: _this.attr('action'),
		    	type: 'POST',
		    	dataType: 'json',
		    	data: _this.serialize()
		    })
		    .done(function(json) {
		    	if (json.code == 200) {
		    		toastr.success(json.message);
		    		setTimeout(function(){
				        window.location.reload();
				    }, 1500);
		    	}else {
		    		toastr.error(json.message);
		    	}
		    	setTimeout(function(){
			        _this.removeClass('in-loading-form');
			    }, 300);
		    })
    	});
    }
    var ratingUsfulNew = function(){
    	$('.rating-new-info button').click(function(event) {
    		event.preventDefault();
    		var _this = $(this);
    		var parent = _this.closest('.rating-new-info');
    		if (parent.find('.active').length > 0) {
    			toastr.success('Bạn đã đánh giá bài viết này rồi!');
    			return;
    		}
    		_this.addClass('active');
    		$.ajax({
    			url: parent.data('action'),
    			type: 'POST',
    			dataType: 'json',
    			data: {
    				new: parent.data('new'),
    				type: _this.data('type')
    			}
    		})
    		.done(function(json) {
    			if (json.code == 200) {
		    		toastr.success(json.message);
		    	}else {
		    		_this.removeClass('active');
		    		toastr.error(json.message);
		    	}
    		})
    	});
    }
    return {_:function(){
        paginateAjax();
        sendContact();
        ratingUsfulNew();
    }
};
})();
$(document).ready(function(){
	GUI._();
	SLIDER._();
	SEARCH._();
	AJAX_SP._();
})