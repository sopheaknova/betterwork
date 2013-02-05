
// Adds a class 'js_on' to the <html> tag if JavaScript is enabled,
// also helps remove flickering...
document.documentElement.className += 'js_on';

// Scroll to Top script
jQuery(document).ready(function($){
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
});


/**
 * CoolInput Plugin
 *
 * @version 1.5 (10/09/2009)
 * @requires jQuery v1.2.6+
 * @author Alex Weber <alexweber.com.br>
 * @author Evan Winslow <ewinslow@cs.stanford.edu> (v1.5)
 * @copyright Copyright (c) 2008-2009, Alex Weber
 * @see http://remysharp.com/2007/01/25/jquery-tutorial-text-box-hints/
 *
 * Distributed under the terms of the GNU General Public License
 * http://www.gnu.org/licenses/gpl-3.0.html
 */
jQuery(document).ready(function($){
    $.fn.coolinput=function(b){
	var c={
	    hint:null,
	    source:"value",
	    blurClass:"blur",
	    iconClass:false,
	    clearOnSubmit:true,
	    clearOnFocus:true,
	    persistent:true
	};if(b&&typeof b=="object")
	    $.extend(c,b);else
	    c.hint=b;return this.each(function(){
	    var d=$(this);var e=c.hint||d.attr(c.source);var f=c.blurClass;function g(){
		if(d.val()=="")
		    d.val(e).addClass(f)
		    }
	    function h(){
		if(d.val()==e&&d.hasClass(f))
		    d.val("").removeClass(f)
		    }
	    if(e){
		if(c.persistent)
		    d.blur(g);if(c.clearOnFocus)
		    d.focus(h);if(c.clearOnSubmit)
		    d.parents("form:first").submit(h);if(c.iconClass)
		    d.addClass(c.iconClass);g()
		}
	    })
	}
    });
jQuery(document).ready(function($){
	// first input box is a search box, notice passing of a custom class and an icon to the coolInput function
	$('#search_field').coolinput({
		blurClass: 'blur'
	});
});

// jQuery Validate
jQuery(document).ready(function($){
    if( $('body').hasClass('page-template-page-contact-php') ) {
	// load js translated strings only when Contact page template is loaded
	$("#contactForm").validate({
	    rules: {
		    contact_name: {
			    required: true,
			    minlength: 2
		    },
		    contact_email: {
			    required: true,
			    email: true
		    },
		    contact_message: $('input#rules_contact_message').val()
	    },
	    messages: {
		    contact_name: {
			    required: $('input#contact_name_required').val(),
			    minlength: $('input#contact_name_min_length').val()
		    },
		    contact_email: $('input#messages_contact_email').val(),
		    contact_message: $('input#messages_contact_message').val()
	    }
	});
	// phone number + extension format validator
	$("#contact_phone_NA_format").mask("(999) 999-9999");
	$("#contact_ext_NA_format").mask("? 99999");
    }
});

// Content Toggle
jQuery(function($){
    // Initial state of toggle (hide)
    $(".slide_toggle_content").hide();
    // Process Toggle click (http://api.jquery.com/toggle/)
    $("h4.slide_toggle").toggle(function(){
	    $(this).addClass("clicked");
	}, function () {
	    $(this).removeClass("clicked");
    });
    // Toggle animation (http://api.jquery.com/slideToggle/)
    $("h4.slide_toggle").click(function(){
	$(this).next(".slide_toggle_content").slideToggle();
    });
});

// Content Accordion
jQuery(document).ready(function($){
    $('.accordion-container').hide();
    $('.accordion-toggle:first').addClass('active').next().show();
    $('.accordion-toggle').click(function(){
        if( $(this).next().is(':hidden') ) {
            $('.accordion-toggle').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
        }
        return false; // Prevent the browser jump to the link anchor
    });
});

//Page Peel
jQuery(document).ready(function($){
    $("#page-peel").hover(function() {
	$("#page-peel img, .msg_block").stop()
	.animate({ width: '307px', height: '319px' }, 500);
    }, function() {
	$("#page-peel img").stop()
	.animate({ width: '50px', height: '52px' }, 220);
	$(".msg_block").stop()
	.animate({ width: '50px', height: '50px' }, 200);
    });
});

// remove the title attributes from the Subpages Widget
jQuery(document).ready(function($) {
        // remove 'title' attribute from menu items
        $("#navigation-menu a, .widget_subpages a").removeAttr("title");
        // Add the 'default' cursor when hover to menu link that have no links
        $('#navigation-menu a').each(function() {
            if ( !$(this).attr("href") ) {
                $(this).addClass("default-cursor");
            }
        });
});

// Tabs
jQuery(document).ready(function($){
	$('.tabs a').click(function(){
		switch_tabs($(this));
	});
	switch_tabs($('.defaulttab'));
	function switch_tabs(obj) {
		$('.tab-content').hide();
		$('.tabs a').removeClass("selected");
		var id = obj.attr("rel");
		$('#'+id).show();
		obj.addClass("selected");
	}
});

// Add class last to 3 Cols Sidebar Home
jQuery(document).ready(function($){
	$("#sidebar-home-3col .widget-box:eq(2)").addClass("last");
});

// Add class last to 3 Cols Sidebar Home
function mycarousel_initCallback(carousel) {
	jQuery('#carousel-next').bind('click', function() {
        carousel.next();
        return false;
    });

    jQuery('#carousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
}
jQuery(document).ready(function($){
	$("#donor-carousel").jcarousel({
        scroll: 1,
		auto: 3,
		wrap: 'last',
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });
	
});

// Custom script on layout
jQuery(document).ready(function($){
	if($(".copyright ul").children().length > 0){
		$(".copyright ul li:last").html($(".copyright ul li:last").html().replace("</a> -","</a>"));
	}

    //dropdown
    $("#navigation ul.nav a").removeAttr('title');
    $(" #navigation ul.nav ul").css({display: "none"}); // Opera Fix
    $("#navigation ul.nav li").each(function()
            {	
    var jQuerysubmeun = $(this).find('ul:first');
    $(this).hover(function()
            {	
    jQuerysubmeun.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:0}).slideDown(250, function()
            {
    $(this).css({overflow:"visible", height:"auto"});
            });	
            },
    function()
            {	
    jQuerysubmeun.stop().slideUp(250, function()
            {	
    $(this).css({overflow:"hidden", display:"none"});
                    });
            });	
    });
	
	// Add Home icon on main menu
	$('.nav_wrap>ul>li:first-child>a').addClass("homeicon");
	
	//scroll to top
	$('.scrollTo_top').hide();
		$(window).scroll(function () {
			if( $(this).scrollTop() > 100 ) {
				$('.scrollTo_top').fadeIn(300);
			}
			else {
				$('.scrollTo_top').fadeOut(300);
			}
		});
	
		$('.scrollTo_top a').click(function(){
			$('html, body').animate({scrollTop:0}, 500 );
			return false;
		});
});
