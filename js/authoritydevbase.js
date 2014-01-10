function ADstickyNav() {
	var stickyNavTop = jQuery(authoritydevbaseDefaults.StickyNavTarget).offset().top + 100;  
		var stickyNav = function(){  
		var scrollTop = jQuery(window).scrollTop();  
		if (scrollTop > stickyNavTop) {  
			jQuery('body').addClass('fixed-sticky'); 
			jQuery('body').css('margin-top', jQuery(authoritydevbaseDefaults.StickyNavTarget).height() ); 
		} else {  
			jQuery('body').removeClass('fixed-sticky'); 
			jQuery('body').attr("style",""); 
		}
	};  
		jQuery(window).scroll(function() { stickyNav(); }); 
}

function ADbackToTop() {
	jQuery('.site-container').prepend('<a id="authorityDev-top" name="authorityDev-top"></a>');
	jQuery('.site-footer .wrap').prepend('<a href="#authorityDev-top" id="back-to-top">'+authoritydevbaseDefaults.BackToTopText+'</a>');
	jQuery('#back-to-top').click(function(){jQuery('body,html').animate({scrollTop:jQuery("#authorityDev-top").offset().top -100},600);return false;});	
}

function ADmobileNav() {
	jQuery('.nav-primary').addClass('responsive-menu').before('<i id="mobile-nav-control"></i>');
}


jQuery(document).ready(function(){ // Add js class to body if js is enabled
	jQuery('body').addClass('js');
	ADmobileNav();
	if (authoritydevbaseDefaults.BackToTop == 1) { ADbackToTop(); }
	if (authoritydevbaseDefaults.StickyNav == 1) { ADstickyNav(); }
}); // End document ready

jQuery(window).on('load', function(){ // Add js below to be loaded after everything else has loaded
jQuery("#mobile-nav-control").click(function(){
	jQuery('.site-container').toggleClass('mobile-nav-showing');	
});
}); // End onload


