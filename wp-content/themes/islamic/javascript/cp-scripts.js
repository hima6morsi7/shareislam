jQuery(document).ready(function(){


	// Menu Navigation
	jQuery('ul.sf-menu').supersubs({
		minWidth: 14.5,
		maxWidth: 27,
		extraWidth: 1
	}).superfish({
		delay: 100,
		speed: 'fast',
		animation: {opacity:'show',height:'show'}
	});
	
	jQuery(".sf-with-ul").hover(function(){
	jQuery(this).animate({ top:'5' }, 400);
	}, function(){
	jQuery(this).animate({ top:'0' }, 400);
	}); 
	
	// Accordion
	jQuery("ul.cp-accordion li").each(function(){
		//jQuery(this).children(".accordion-content").css('height', function(){ 
			//return jQuery(this).height(); 
		//});
		
		if(jQuery(this).index() > 0){
			jQuery(this).children(".accordion-content").css('display','none');
		}else{
			jQuery(this).find(".accordion-head-image").addClass('active');
		}
		
		jQuery(this).children(".accordion-head").bind("click", function(){
			jQuery(this).children().addClass(function(){
				if(jQuery(this).hasClass("active")) return "";
				return "active";
			});
			jQuery(this).siblings(".accordion-content").slideDown();
			jQuery(this).parent().siblings("li").children(".accordion-content").slideUp();
			jQuery(this).parent().siblings("li").find(".active").removeClass("active");
		});
	});
	
	// Toggle Box
	jQuery("ul.cp-toggle-box li").each(function(){
		//jQuery(this).children(".toggle-box-content").css('height', function(){ 
			//return jQuery(this).height(); 
		//});
		jQuery(this).children(".toggle-box-content").not(".active").css('display','none');
		
		jQuery(this).children(".toggle-box-head").bind("click", function(){
			jQuery(this).children().addClass(function(){
				if(jQuery(this).hasClass("active")){
					jQuery(this).removeClass("active");
					return "";
				}
				return "active";
			});
			jQuery(this).siblings(".toggle-box-content").slideToggle();
		});
	});
	
	// Search Movement
	jQuery(".search-wrapper").filter(":first").find("#searchsubmit").click(function(){
		if( jQuery(this).siblings("#search-text").width() == 1 ){
			jQuery(this).siblings("#search-text").children("input[type='text']").val('');
			jQuery(this).siblings("#search-text").animate({ width: '170px' });
			jQuery(this).siblings("#search-text").children("input[type='text']").focus();
			return false;
		}
		if( jQuery(this).siblings("#search-text").children("input[type='text']").val() == '' ){
			return false;
		}
	});
	jQuery("#searchform").click(function(){
	   if (event.stopPropagation){
		   event.stopPropagation();
	   }
	   else if(window.event){
		  window.event.cancelBubble=true;
	   }
		//event.stopPropagation();
	});
	jQuery("html").click(function(){
		jQuery(this).find(".search-wrapper").filter(":first").find("#search-text").animate({ width: '1px' });
	});
	
	// Social Hover
	jQuery(".social-media-icons-footer .social-icon").hover(function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	});
	
	// Scroll Top
	jQuery('.scroll-top').click(function() {
		  jQuery('html, body').animate({ scrollTop:0 }, { duration: 600, easing: "easeOutExpo"});
		  return false;
	});
	
	// Logo Hover
	jQuery("#logo").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Blog Hover
	jQuery(".blog-thumbnail-image img").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Gallery Hover
	jQuery(".gallery-thumbnail-image img").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	
	jQuery("div.custom-sidebar ul li").hover(function(){
		jQuery(this).animate({ left: 5 }, 150);
	}, function(){
		jQuery(this).animate({ left: 0 }, 150);
	});

	jQuery(".column-service-content.style-1").hover(function(){
		jQuery(this).find('.txt-btn').animate({ left:'86%', opacity:'1'}, 1000, 'easeOutExpo');
	}, function(){
		jQuery(this).find('.txt-btn').animate({opacity:'0', left:'-20%' }, 800, 'easeInExpo');	
	})
	
	jQuery(".recent-post-widget").hover(function(){
		jQuery(this).find('a').animate({ color:'#000'}, 300, 'easeOutExpo');
	}, function(){
		jQuery(this).find('a').animate({ color:'#000'}, 300, 'easeInExpo');
	});

	// Port Hover
	jQuery("#portfolio-item-holder .portfolio-thumbnail-image").hover(function(){
		/*jQuery(this).animate({ top: -5 }, 100, 'easeOutExpo');*/
		jQuery(this).find('span').animate({ left: '50%'}, 300, 'easeOutExpo');
		jQuery(this).find (".portfolio-thumbnail-image-hover").animate({ opacity: '1'}, 300, 'easeOutExpo');
		/*jQuery(this).find(".port-shadow").animate({ bottom: '-3'}, 300, 'easeOutExpo');*/
		
		
	}, function(){
		jQuery(this).find('span').animate({ left: '150%'}, 300, 'easeInExpo', function(){
			jQuery(this).css('left','-50%');
		});
	/*	jQuery(".port-shadow").animate({ bottom: '0'}, 300, 'easeInExpo');*/
	/*	jQuery(this).animate({ top: 0 }, 100, 'easeInExpo');
*/		jQuery(".portfolio-thumbnail-image-hover").animate({ opacity: '0'}, 300, 'easeInExpo');
	});
	
	// Price Table
	jQuery(".cp-price-item").each(function(){
		var max_height = 0;
		jQuery(this).find('.price-item').each(function(){
			if( max_height < jQuery(this).height()){
				max_height = jQuery(this).height();
			}
		});
		jQuery(this).find('.price-item').height(max_height);
		
	});

});

jQuery(window).load(function(){

	// Set Portfolio Max Height
	var port_item_holder = jQuery('div#portfolio-item-holder');
	port_item_holder.equalHeights();
	jQuery(window).resize(function(){
		port_item_holder.children().css('height','auto');
		port_item_holder.equalHeights();
	});
	
	// Set Sidebar height
	var content_wrapper = jQuery('.content-wrapper').filter(':first');
	var left_sidebar_wrapper = content_wrapper.find('.left-sidebar-wrapper').filter(':first');
	var right_sidebar_wrapper = content_wrapper.find('.right-sidebar-wrapper').filter(':first');
	content_wrapper.each(function(){
		max_height = jQuery(this).height();
		top_slider_height = jQuery(this).find('.slider-wrapper.fullwidth').height();
		
		max_height = max_height - top_slider_height;
		left_sidebar_wrapper.height(max_height);
		right_sidebar_wrapper.height(max_height);
	});
	
	jQuery(window).resize(function(){
		left_sidebar_wrapper.css('height', 'auto');
		right_sidebar_wrapper.css('height', 'auto');
		content_wrapper.each(function(){
			max_height = jQuery(this).height();
			top_slider_height = jQuery(this).find('.slider-wrapper.fullwidth').height();
			
			max_height = max_height - top_slider_height;
			left_sidebar_wrapper.height(max_height);
			right_sidebar_wrapper.height(max_height);
		});	
	});

});


/* Tabs Activiation
================================================== */
jQuery(document).ready(function() {

	var tabs = jQuery('ul.tabs');

	tabs.each(function(i) {

		//Get all tabs
		var tab = jQuery(this).find('> li > a');
		var tab_content = jQuery(this).next('ul.tabs-content')
		tab.click(function(e) {

			//Get Location of tab's content
			var contentLocation = jQuery(this).attr('data-href');
			
			//Let go if not a hashed one
			if(typeof( contentLocation ) != 'undefined') {

				e.preventDefault();

				//Make Tab Active
				tab.removeClass('active');
				jQuery(this).addClass('active');

				//Show Tab Content & add active class
				tab_content.children('li[data-href='+ contentLocation +']').fadeIn(200).addClass('active').siblings().hide().removeClass('active');

			}
		});
	});
});

/* Equal Height Function
================================================== */
(function($) {
	$.fn.equalHeights = function(px) {
		$(this).each(function(){
			var currentTallest = 0;
			$(this).children().each(function(i){
				if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
			});
			$(this).children().css({'height': currentTallest}); 
		});
		return this;
	};
})(jQuery);
