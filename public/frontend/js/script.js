var GUI = (function(){
	var initWow = function() {
		var wow = new WOW();
		wow.init();
	}
 	var flashNotification = function(){
 		$('.flash-notification .close-icon').click(function(event) {
 			$(this).closest('.flash-notification').slideUp(300);
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
        	language: 'vi',
        	onClose: function () {
        		alert('éc éc');
        	}
  		}).datepicker('update', new Date());
  		$('#datepicker-medical input').val('');
  		$('#datepicker-medical input').val('Ngày đặt');
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
	return {
		_:function(){
			flashNotification();
			initMenuChild();
			bindDatePickerMedical();
			initWow();
			initSearch();
			initMenuShow();
			backToTop();
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
		}
	};
})();

$(document).ready(function(){
	GUI._();
	SLIDER._();
})