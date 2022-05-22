jQuery.noConflict();


/* ct accordion */
function ctAccordionInit() {
	jQuery(".ctAccordion").ctAccordion({
		easing: "easeOutBounce", speed: 1500
	});
}


/* tooltip for socials init */

function tooltipInit() {

	jQuery("[data-toggle='tooltip']").tooltip();
}


function portfolioSort() {
	/*** Quicksand ***/
	var p = jQuery('#portfolio1');
	var f = jQuery('.filterPortfolio');
	var data = p.clone();
	f.find('a').click(function () {
		var link = jQuery(this);
		var li = link.parents('li');
		if (li.hasClass('active')) {
			return false;
		}

		f.find('li').removeClass('active').find('a').removeClass('btn-primary');

		li.addClass('active').find('a').addClass('btn-primary');

		//quicksand
		var filtered = li.data('filter') ? data.find('li[data-filter~="' + li.data('filter') + '"]') : data.find('li');

		p.quicksand(filtered, {
			duration: 800, adjustHeight: false, easing: 'easeInOutQuad'
		}, function () { // callback function

			jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel'});

		});
		return false;
	});
}


function nivoSliderInit() {
	jQuery('.nivoSlider').nivoSlider({
		effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
		slices: 15, // For slice animations
		boxCols: 8, // For box animations
		boxRows: 4, // For box animations
		animSpeed: 500, // Slide transition speed
		pauseTime: 6000, // How long each slide will show
		startSlide: 0, // Set starting Slide (0 index)
		directionNav: true, // Next & Prev navigation
		controlNav: true, // 1,2,3... navigation
		controlNavThumbs: false, // Use thumbnails for Control Nav
		pauseOnHover: true, // Stop animation while hovering
		manualAdvance: false, // Force manual transitions
		prevText: 'Prev', // Prev directionNav text
		nextText: 'Next', // Next directionNav text
		randomStart: false, // Start on a random slide
		beforeChange: function () {
		}, // Triggers before a slide transition
		afterChange: function () {
		}, // Triggers after a slide transition
		slideshowEnd: function () {
		}, // Triggers after all slides have been shown
		lastSlide: function () {
		}, // Triggers when last slide is shown
		afterLoad: function () {
		} // Triggers when slider has loaded
	});
}


function accordionActive() {

	jQuery(".accordion").on("show", function (e) {
		jQuery(e.target).prev(".accordion-heading").find(".accordion-toggle").addClass("active");
	}).on("hide", function (e) {
		jQuery(this).find(".accordion-toggle").not(jQuery(e.target)).removeClass("active");
	}).each(function () {
		var $a = jQuery(this);
		$a.find("a.accordion-toggle").attr("data-parent", "#" + $a.attr("id"));
	});
}


/* scrool spy faq with smooth scroll */
function faqSmoothScroll() {
	jQuery('.faqMenu a').bind('click', function (e) {
		e.preventDefault();
		jQuery('html, body').animate({
			scrollTop: jQuery(this.hash).offset().top
		}, 300);
	});
}


function linearFlexsliderInit() {
	jQuery('.flexslider.flexLinear').flexslider({
		animation: 'slide', animationLoop: false, slideshow: false, controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true, start: function () {
			overlayContent('reload');
		}
	});
}

function fadeFlexsliderInit() {
	jQuery('.flexslider.fadeFlex').flexslider({
		animation: 'fade', animationLoop: false, slideshow: false, controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true, start: function () {
			overlayContent('reload');
		}
	});
}

function fullFlexsliderInit() {
	jQuery('.flexslider.flexFull').flexslider({
		animation: "slide", slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 600, pauseOnAction: true, controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true
	});
}

function carouselFlexsliderInit() {
	jQuery('.flexslider.flexCarousel').flexslider({
		animation: "slide", animationLoop: true, itemWidth: 140,                   //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
		minItems: 2,                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
		maxItems: 6,                    //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
		move: 0,                        //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
		controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true
	});
}


function contentFlexsliderInit() {
	jQuery('.flexslider.flexContent').flexslider({
		animation: "slide", slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 600, pauseOnAction: true, controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true
	});
}


/* content on hover */
function overlayContent(i) {
	if (i == 'init') {
		jQuery('.contentoverlay').contenthover({
			overlay_opacity: 0.6, effect: 'fade',                 // [fade, slide, show] The effect to use
			fade_speed: 400,                // Effect ducation for the 'fade' effect only
			slide_speed: 400,               // Effect ducation for the 'slide' effect only
			slide_direction: 'bottom'      // [top, bottom, right, left] From which direction should the overlay apear, for the slide effect only
		});
	}
	if (i == 'reload') {
		/* responsive overlay fix */
		jQuery('.ch_element').remove();
		jQuery('.contentoverlay').show();
		overlayContent('init');
	}
}

/* link smooth scroll to top */
function scrollToTop(i) {
	if (i == 'show') {
		if (jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();
		} else {
			jQuery('#toTop').fadeOut();
		}
	}
	if (i == 'click') {
		jQuery('#toTop').click(function () {
			jQuery('body,html').animate({scrollTop: 0}, 600);
			return false;
		});
	}
}

/* twitter live feed */
function twitterFeed() {
	/* twitter */

	if (jQuery().tweet) {
		jQuery('.tweets').each(function () {
			var $this = jQuery(this);
			var limit = ($this.attr("data-limit")) ? ('?limit='+$this.attr("data-limit")) : '';
			$this.tweet({
				template: "{text} {time}", //li_class: " ",
				twitter_api_url: 'twitter/proxy/twitter_proxy.php' + limit
			});
		});
	}

}


jQuery(document).ready(function () {
	overlayContent('init');
	scrollToTop('click');
	accordionActive();
	portfolioSort();
	tooltipInit();
	ctAccordionInit();
	faqSmoothScroll();
	twitterFeed();
});

jQuery(window).resize(function () {
	overlayContent('reload');
});

jQuery(window).scroll(function () {
	scrollToTop('show');
});

jQuery(window).load(function () {
	fullFlexsliderInit();
	linearFlexsliderInit();
	fadeFlexsliderInit();
	contentFlexsliderInit();
	carouselFlexsliderInit();
	nivoSliderInit();
});

