(function($) {
  "use strict";
  //fun facts conter
	jQuery('.count-wrap').each(function() {
		jQuery(this).appear(function() {
			var $endNum = parseInt(jQuery(this).find('.count-number').text());
			jQuery(this).find('.count-number').countTo({
				from: 0,
				to: $endNum,
				speed: 6000,
				refreshInterval: 50,
			});
		},{accX: 0, accY: 0});
	});

	//isotope stuff
	var $container = $('#container');
	$container.isotope({});
	$(window).load(function(){
		$('#container').isotope();
	});

	//rev slider var
var revapi; 

	jQuery(document).ready(function( $ ) {
		//glide js
		$('.slider').glide({
	        autoplay: 5000,
	        arrows: '#slider-buttons',
	        arrowRightText: '',
	        arrowLeftText: '',
	        nav: false
	    });
	    
		//simple carousel one per turn
		$(".owl-carousel").owlCarousel({ 
			items: 3
		});

		//start fancybox
		$(".fancybox").fancybox();

		//isotope stuff		
		$('#isotope-filters a').click(function(){
			var selector = $(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});	
		//faq accordion stuff
		$.fn.accordion_cf = function() {
			$('.accordion-wrap .accordion-head').click(function(e){
				e.preventDefault();
				$(this).closest('li').find('.accordion-content').not(':animated').slideToggle();
				
			});
			$(".accordion-wrap li").click(function(){
			    $(this).toggleClass("opened");
			});
		}; 
		var $container_aaa= $('.faq-wrapper');
		$container.accordion_cf();

		//Fix the menu on the menu when responsive, show only top levels please
	    $('.main-nav ul li:has(ul)').addClass('dropdown');
		$( "li.dropdown" ).click( function() {
	        $(this).toggleClass( "active" );
	    });

		//Handle the portfolion single active + isotope filters active link stuff
		$( ".team-item-wrap" ).click( function() {
		    if( $(this).is('.active') ) {
		        $(this).removeClass( "active" );
		    }
		    else {
		        $( ".active" ).removeClass( "active" );
		        $(this).addClass( "active" );
		    }
		});

		$( "#isotope-filters li a" ).click( function() {
		    if( $(this).is('.active') ) {
		        $(this).removeClass( "active" );
		    }
		    else {
		        $( ".active" ).removeClass( "active" );
		        $(this).addClass( "active" );
		    }
		});

		// Revslider from Kreatura Media with Transitions
		/*revapi = jQuery('.tp-banner').revolution({
				delay:9000,
				startwidth:1170,
				startheight:600,
				navigationStyle:'custom_bullets',
				fullWidth:'on',
				forceFullWidth:'on'
			});

		// LayerSlider from Kreatura Media with Transitions
		$('#layerslider').layerSlider({
			responsive: true,
			responsiveUnder : 970,
			skinsPath : 'img/layer_slider/skins/',
			skin: 'cinergy',
			thumbnailNavigation: 'disabled',
			showCircleTimer: false,
			hoverPrevNext: false
		});*/
		
		//Likes---------------------------------------------------------
		$('body').on('click','.meta-info-buttons.likes-no a',function(event){
			event.preventDefault();
			
				var like_box = $(this);
				var post_id = like_box.data('post');
				var likes = parseInt(like_box.text());
				likes++
				
				
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {action: 'cinergy_like_post', id:post_id},
				})
				.done(function(result) {
					if(result === 'liked'){
						like_box.html(likes);
					}
					console.log(result);
				})
				.fail(function() {
					console.log("error-ajax");
				});
				
			
			return false;
		});

		/* ================= CONTACT FORM ================= */
	    $('#contact-form').submit(function(e) {
	        e.preventDefault();
	        var form = $(this);
	        var submit = form.find('input[type=submit]');
	        var submit_val = $(submit).val();
	        var action = '&action=' + form.attr('action');

	        $.post(ajaxurl, form.serialize() + action, function(result) {
	            submit.val(result);
	            setTimeout(function() {
	                    submit.val(submit_val);
	                }, 3000);
				//console.log(result);
	        });
	        
	        return false;
	    });

	    /* ================= AJAX LOAD MORE ================= */
	    $('.load-more-items').on('click',function(event){
	    	console.log(portfolio_category)
	    	event.preventDefault();
	    	page ++;
	    	$.ajax({
			  type: "POST",
			  url: ajaxurl,
			  data: { action:'load_more_portfolio', page:page , masonry:masonry,columns:columns ,portfolio_category:portfolio_category},
			  dataType: 'html'
			})
			  .done(function( html ) {
			  	//console.log(html)
			  	if(masonry){
			    	$('#container').isotope( 'insert', $(html) );
			    }else{
			    	if($('.portfolio-article').length % columns != 0){
			    		var rest = columns - $('.portfolio-article').length % columns;
			    		console.log(rest);
			    		$('.portfolio-wrapper > .row').last().append($(html).find('.portfolio-article').slice(0,rest));
			    		var $other_rows = $(html).find('.portfolio-article').slice(rest,$(html).find('.portfolio-article').length);
			    		var output = '<div class="row">';
			    		$other_rows.each(function(index,article){
			    			if(index != 0 && index % columns == 0){
			    				output += '</div><div class="row">' + $(article)[0].outerHTML;
			    			}else{
			    				output += $(article)[0].outerHTML;
			    			}
			    		});
			    		output +='</div>';
			    		console.log(output)
			    		$('.portfolio-wrapper').append(output)
			    	}else{
			    		$('.portfolio-wrapper').append(html)
			    	}
			    }
			    if (page == max_num_pages){
			    	$('.load-more-items').hide()
			    }
		  	})
			  .fail(function( jqXHR, textStatus ) {
			  	alert( "Request failed: " + textStatus );
			});

	    	return false;
	    });

		/* 
		 * Return outerHTML for the first element in a jQuery object,
		 * or an empty string if the jQuery object is empty;  
		 */
		//jQuery.fn.outerHTML = function() {
		//   return (this[0]) ? this[0].outerHTML : '';  
		//};
		
		
		
		$('#signup-form').submit(function(e){
			//Validate the data first
			e.preventDefault();
			var $this = this;
			console.log('form submit');


			var feedback = jQuery('#cf-feedback');
			var valid = true;
			var msg = "";


			// Name
			if(jQuery('#signup-name').val().length==0){
				valid = false;
				msg+= '<p class="msg">&raquo; Enter your name</p>';
				jQuery('#signup-name').addClass('alert-error');
				jQuery('#signup-name').focus();
				jQuery('#signup-name').blur();
			}else{
				jQuery('#signup-name').removeClass('alert-error');
			}
			// Email Address
			if(!validateEmail(jQuery('#signup-email').val())){
				valid = false;
				msg+= '<p class="msg">&raquo; Enter a valid email address</p>';
				jQuery('#signup-email').addClass('alert-error');
				jQuery('#signup-email').focus();
				jQuery('#signup-email').blur();
			}else{
				jQuery('#signup-email').removeClass('alert-error');
			}
			
			jQuery(feedback).removeClass('alert-success alert-info alert-error');
			
			if(valid){
				jQuery.getJSON(
				"http://chemicalcodelimited.createsend.com/t/y/s/alkhjj/?callback=?",
				jQuery('#signup-form').serialize(),
				function (data) {
					console.log(data);
					if (data.Status === 400) {
						valid = false;
						msg+= '<p class="msg">&raquo; ' + data.Message + '</p>'
					} else { // 200
						var msghtml = "<p><strong>Thank you for subscribing!</strong></p>" + msg;
						jQuery(feedback).removeClass('alert-success alert-info alert-error');
						jQuery(feedback).addClass('alert-info').find('.msg').html(msghtml);
						jQuery('#signup-name').val('');
						jQuery('#signup-email').val('');
					}
				});
			}else{
				var errorhtml = "<p><strong>Please correct the following errors:</strong></p>" + msg;
				jQuery(feedback).addClass('alert-error').css('display','block');
				jQuery(feedback).find('.msg').html(errorhtml);
			}
			return false;
		});
	});
})(jQuery);

function validateEmail(elementValue){  
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
        return emailPattern.test(elementValue);
}

jQuery(window).resize(function(){
        if(showScreenInfo){
                var documentWidth = jQuery(window).width(); //retrieve current document width
                jQuery('#screen-width-txt').text(documentWidth);
        }else{
			jQuery('#screen-info').css('display', 'none');
		}
});