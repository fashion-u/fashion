function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}
function ValidateIPaddress(value){  
    if(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(value)){  
        return (true)  
    }  
    return (false)  
}  

// head-menu
$(document).ready(function() {
	//$('.menu-button').on('click', function(){
	//	$('.tablet-menu').slideToggle();
	//});
	//$('.close-tablet-menu').on('click', function(){
    //    var id = $('.tab-link2 .active').attr('href');
    //    if ( $(window).width() < 768 && $(id +' .left-side').is(':hidden') ) {
    //        $(id +' .right-side').hide();
    //        $(id +' .left-side').show();
    //    } else {
    //        $('.tablet-menu').slideToggle();
    //    }
	//});
	
//    $('.menu-button, .tab-link2 a').magnificPopup({
	$('.menu-button, .pm-link-level1 a, .pm-link-level2 ul li a, .pm-back').magnificPopup({
        type: 'inline',
        closeBtnInside: false,
        showCloseBtn: false,
        disableOn: function() {
			  if( $(window).width() > 1298 ) {
			    return false;
			  }
			  return true;
			}
    });
	
});
// end head-menu

// checkbox  and radio
jQuery(function($){
	$('input[type=radio], input[type=checkbox]').iCheck();
});
// end checkbox and radio

//  select
jQuery(function($){
	$("select").selectBoxIt();
});
// end select

//placeholder ie
$(document).ready(function() {
    
    console.log(tmp_dir);
	/* Placeholder for IE */
	if($.support.msie) { // ������� ��� ������ ������ � IE
		$("form").find("input[type='text']").each(function() {
			var tp = $(this).attr("placeholder");
			$(this).attr('value',tp).css('color','#A9A9A9');
		}).focusin(function() {
			var val = $(this).attr('placeholder');
			if($(this).val() == val) {
				$(this).attr('value','').css('color','#747b80');
			}
		}).focusout(function() {
			var val = $(this).attr('placeholder');
			if($(this).val() == "") {
				$(this).attr('value', val).css('color','#A9A9A9');
			}
		});
		/* Protected send form */
		$("form").submit(function() {
			$(this).find("input[type='text']").each(function() {
				var val = $(this).attr('placeholder');
				if($(this).val() == val) {
					$(this).attr('value','');
				}
			})
		});
	}
});
//end placeholder ie

// main menu
jQuery(function($){
	var titles = $(".filter-link");
	var content = $(".drop-filter-box");

	titles.on("click touchstart", function(e) {
		if ($(window).width() > 1298) {
            if ($(this).next(".drop-filter-box")
                    .is(":visible")) {
                $(this).next(".drop-filter-box")
                    .slideUp('fast');
                    
                $(this).css('border-bottom','none');
                $('.filter-box-wrap2').css("height", "28px");
            } else {
                
                $('.filter-link').each(function(index){
                    $(this).css('border-bottom','none');
                });
                
                content.slideUp()
                    .eq($(this).index(".filter-link"))
                    .slideDown('fast');
                $(this).css('border-bottom','2px solid #F8AA1C');
                $('.filter-box-wrap2').css("height", "400px");
                var l = $(this).siblings('.drop-filter-box').offset().left;
                var w = $(this).siblings('.drop-filter-box').width();
                if ( l-w < 380) {
                    $('.drop-filter-box').removeClass('drop-filter-box__left');
                    $('.drop-filter-box').removeClass('drop-filter-box__right');
                    $('.drop-filter-box').addClass('drop-filter-box__left');
                } else {
                    $('.drop-filter-box').removeClass('drop-filter-box__left');
                    $('.drop-filter-box').removeClass('drop-filter-box__right');
                    $('.drop-filter-box').addClass('drop-filter-box__right');                            
                }
            }
        }
	});
});
// end main menu

// tablet-menu and mobile menu
$(document).ready(function() {
    //$('.tab-cont2 .left-side ul li a').on('click', function(){
    //    if ( $(this).hasClass('active') ) {
    //        var url = $(this).attr('data-link');
    //        $(location).attr('href', url);
    //    } else {
    //        $('.tab-cont2 .left-side ul li a').removeClass('active');
    //        var active_class = $(this).attr("class");
    //        $(this).addClass('active');
    //        var parent_tab = $(this).closest('div').parent().attr('id');

    //        $('#' + parent_tab + ' .right-side > div').removeClass('active');
    //        $('#' + parent_tab + ' .right-side > div').hide();
    //        $('#' + parent_tab + ' .right-side .' + active_class).addClass('active');
    //        $('#' + parent_tab + ' .right-side .' + active_class).show();
    //        
    //        // mobile
    //        if ( $(window).width() < 768 && $('#' + parent_tab + ' .right-side').is(':hidden') ) {
    //            $('.tab-cont2 .left-side').hide();
    //            $('#' + parent_tab + ' .right-side').show();
    //        }
    //        return false;
    //    }
    //});

    //var tabContainers = $('div.tab-cont2 > div');
    //tabContainers.hide().filter(':first').show();
    //$('div.tab-link2 a').click(function () {
    //    tabContainers.hide();
    //    tabContainers.filter(this.hash).show()
    //    if ( $(window).width() < 768 && $(this.hash + ' .left-side').is(':hidden') ) {
    //        $(this.hash + ' .right-side').hide();
    //        $(this.hash + ' .left-side').show();
            
    //    }
    //    $('div.tab-link2 a').removeClass('active');
    //    $(this).addClass('active');
    //    $(this.hash + ' .left-side ul li a').removeClass('active');
    //    $(this.hash + ' .right-side > div').removeClass('active');
    //    if ( $(window).width() > 767 ) {
    //        $(this.hash + ' .item-1').click();
    //    }

    //    //$(this.hash + ' .item-1').addClass('active');
    //    //$(this.hash + ' .left-side .active').click();
    //    return false;
    //}).filter(':first').click();
});
// end tablet-menu and mobile menu

//Filter send
	$(document).on('click', '.yellow-button', function(){
		//form.submit();    
	});

// filter-drop-box
//$(document).ready(function() {
//	$('.filter-button').on('click', function(){
//		$('.filter-line').slideToggle('medium');
//	});
//	$('.filter-drop .yellow-button').on('click', function(){
//		$('.filter-drop').slideToggle('medium');
//	});
//});
// end filter-drop-box

// filter (tablet)
$(document).ready(function() {
    $('.filter-button, .drop-filter-botton-reset, .drop-filter-botton-ok, .filter-link').magnificPopup({
        type: 'inline',
        closeBtnInside: false,
        showCloseBtn: false,
        disableOn: function() {
			  if( $(window).width() > 1298 ) {
			    return false;
			  }
			  return true;
			}
    });

    if ( $(window).width() > 1298 ) {
    	$('.mfp-hide').removeClass('mfp-hide');
    } else {
    	$('#filter-popup').addClass('mfp-hide');
    	$('.drop-filter-box').addClass('mfp-hide');
    }

    $('.drop-filter-botton-reset').on('click', function(){
    	var d = $(this).closest('div').attr('id');
    	$('#' + d + ' .icheckbox').removeClass('checked');
    	$('#' + d + ' .icheckbox input').removeAttr('checked');
    	// filter price:
    	$('#' + d + ' .filters-price input').val(''); 
    	$('#' + d).parent().children('.selected_filter_list').remove();
    	$('#' + d).parent().children('.dell_filter').remove();
    	$('#' + d).parent().removeClass('filter_selected');
	});

    $('.drop-filter-botton-ok').on('click', function(){
    	var d = $(this).closest('div').attr('id');
    	$('#' + d).parent().children('.selected_filter_list').remove();
    	$('#' + d).parent().children('.dell_filter').remove();
    	$('#' + d + ' .checked').each(function(i,elem){
    		var t = $(this).next().text();
    		var id = $(this).children('.filters').attr('id');
    		$('#' + d).parent().append('<span class="selected_filter_list">' + t + '</span><span class="dell_filter" data-id="' + id + '">&times;</span>');
    	});

        if ($('#' + d + ' .checked').length > 0) {
            $('#' + d).parent().addClass('filter_selected');
        } else {
            $('#' + d).parent().removeClass('filter_selected');
        }

        // price filter
        if ( $('#' + d + ' #price_from').length > 0 ) {
            var v_from = $('#price_from').val();
            var v_to = $('#price_to').val();
            if ( v_from !== '' || v_to !== '' ) {
                $('#' + d).parent().addClass('filter_selected');
                    if ( v_from !== '' ) {
                        $('#price_from').closest('.filter-box').append('<span class="selected_filter_list">\u041E\u0442 ' + v_from + '</span><span class="dell_filter" data-id="price_from">&times;</span>');
                    }
                    if ( v_to !== '' ) {
                        $('#price_to').closest('.filter-box').append('<span class="selected_filter_list">\u0414\u043E ' + v_to + '</span><span class="dell_filter" data-id="price_to">&times;</span>');
                    }
            } else {
                $('#' + d).parent().removeClass('filter_selected');
            }
        } // end price filter
    });

});
// end filter (tablet)

// price filter
$(document).ready(function() {
    var v_from = $('#price_from').val();
    var v_to = $('#price_to').val();

    if ( v_from !== '' || v_to !== '' ) {
        $('#price_from').closest('.filter-box').addClass('filter_selected');
    }
    if ( v_from !== '' ) {
        $('#price_from').closest('.filter-box').append('<span class="selected_filter_list">\u041E\u0442 ' + v_from + '</span><span class="dell_filter" data-id="price_from">&times;</span>');
    }
    if ( v_to !== '' ) {
        $('#price_to').closest('.filter-box').append('<span class="selected_filter_list">\u0414\u043E ' + v_to + '</span><span class="dell_filter" data-id="price_to">&times;</span>');
    }
});
// end price filter

// scroll
jQuery(function($){
	var pane = $('.scrollblock');
	pane.jScrollPane({
		//showArrows: true,
		autoReinitialise: true,
		animateScroll: true,
        speedSwipeX: 4
	});

	var sum_w = 0;
	$('.menu-tablet-line li').each(function(i,elem) {
		var w = $(this).width();
		sum_w += w;
	});
	$('.menu-tablet-line .inner').width(sum_w+41);

	var api = pane.data('jsp');
	$('.menu-tablet-arrow-left').bind(
		'click', function(){
			var step = parseInt($('.menu-tablet-line').css('width')) - 50;
			api.scrollBy(-step, 0);
			return false;
		}
	);
	$('.menu-tablet-arrow-right').bind(
		'click', function(){
			var step = parseInt($('.menu-tablet-line').css('width')) - 50;
			api.scrollBy(step, 0);
			return false;
		}
	);
	
});
// end scroll

// popular
jQuery(function($){
	$('.sort-mobile-box a.item-1').on('click', function(){
		$(this).addClass('active');
		$('.sort-mobile-box a.item-2').removeClass('active');
		$('.product').removeClass('long');
	});
	$('.sort-mobile-box a.item-2').on('click', function(){
		$(this).addClass('active');
		$('.sort-mobile-box a.item-1').removeClass('active');
		$('.product').addClass('long');
	});
});
// end popular

//Click on NO-Link target
$(document).on('click', '.links', function(event){
	var link = $(this).data('link');
//debugger;
	if (event.target.tagName != 'A' && $(event.target).hasClass('as_link') == false) {
		location.href = link;
	}
	
});
$(document).on('click', '.links_blank', function(event){
	//debugger;
    var link = $(this).data('link');

	if (event.target.tagName != 'A' && $(event.target).hasClass('as_link') == false) {
		
		window.open(link, '_blank');
		if ($(this).attr('class').indexOf('helikopter').length > 0) {
			window.location.href = $('#helikopter_next_href').val();
        }
		
	}
	
});
//end Click on NO-Link target

//Click .filter-box
$(document).ready(function() {
	$('.filter-box').on('click', function(){
		if ($('#filter_information').is(':hidden')) {
			$('#filter_information').css("display", "block");
		} else {
			$('#filter_information').css("display", "none");
		};
		//$('#filter_information').delay(3000).fadeOut(); 
	});
});
//end Click .filter-box

//scroll .filter-box-wrap
var filter_i=0;
$(document).ready(function() {
	var arr = [];
	var sum_w = 0;
	$('.filter_selected').each(function(i,elem) {
		var w = $(this).width()+22;
		arr.push(w);
		sum_w += w;
	});
	$('.filter-box:not(".filter_selected")').each(function(i,elem) {
		var w = $(this).width()+22;
		arr.push(w);
		sum_w += w;
	});
	if ($(window).width() > 1298) {
		$('.filter-box-wrap3').width(sum_w+11);
	}

	var animateL = function() {
		if ($('.filter-box-wrap3').position().left < 0) {
			$(this).unbind('click');
			filter_i--;
			$('.filter-box-wrap3').animate({'left':'+='+arr[filter_i]+'px'}, 300, (function(){
                $('.filter-box-wrap-arrow-left').bind('click', animateL);
            	})
            );

		}
	};
	var animateR = function() {
		if ($('.filter-box-wrap3').position().left > -($('.filter-box-wrap3').width() - $('.filter-box-wrap2').width() - 10 )) {
			$(this).unbind('click');
			$('.filter-box-wrap3').animate({'left':'-='+arr[filter_i]+'px'}, 300, (function(){
                $('.filter-box-wrap-arrow-right').bind('click', animateR);
            	})
            );
			filter_i++;
		}		
	};

	$('.filter-box-wrap-arrow-left').bind('click', animateL);
	$('.filter-box-wrap-arrow-right').bind('click', animateR);

	window.onscroll = function() {
		if ($(window).width() > 1298) {
			$('#filter_information').css("display", "none");
			$('.drop-filter-box').css("display", "none");
			$('.filter-box-wrap2').css("height", "28px");
            $('.search').show();
		}
        if ($(window).width() < 1298) {
            $('.search').hide();
        }

	};

	$(document).mouseup(function (e){
		var div = $('#filter_information');
		if (!div.is(e.target)
		    && div.has(e.target).length === 0) {
			div.hide();
		}
		var div = $('.drop-filter-box');
		if (!div.is(e.target)
		    && div.has(e.target).length === 0) {
   			if ($(window).width() > 1298) {
                div.hide();
                $('.filter-box-wrap2').css("height", "28px");
            }
		}
        var div = $('.search');
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            div.hide();
        }
	});

});
//end scroll .filter-box-wrap

// account
$(document).ready(function() {
	$('.dropdown').on('click', function(event){
		$(this).siblings('.dropdown-menu').slideToggle();
	});
	$('.ic-info').hover(function(event){
		$(this).siblings('.pop-up-info').slideToggle();
	});
	$('.dropdown-setup').on('click', function(event){
		$(this).siblings('.dropdown-setup-menu').slideToggle();
	});
 	$('.account-setings').on('click', function(event){
		$('.account-setings-menu').slideToggle();
	});
});
// end accound

  

 $(document).mouseup(function (e){
  var div = $('.dropdown-menu');
  if (!div.is(e.target)
      && div.has(e.target).length === 0) {
   div.hide();
  }
 var div = $('.dropdown-setup-menu');
  if (!div.is(e.target)
      && div.has(e.target).length === 0) {
   div.hide();
  }
 var div = $('.account-setings-menu');
  if (!div.is(e.target)
      && div.has(e.target).length === 0) {
   div.hide();
  }
 });

// search form
$(document).on('click', '.search-button', function(){
    $('.search').slideToggle();
});
// end search form