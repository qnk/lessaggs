/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
(function () {
    "use strict";

    // IE checker
    function gkIsIE() {
        var myNav = navigator.userAgent.toLowerCase();
        return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
    }

    jQuery.cookie = function (key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && String(value) !== "[object Object]") {
            options = jQuery.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=',
                options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var result, decode = options.raw ? function (s) {
                return s;
            } : decodeURIComponent;
        return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
    };

    // Array filter
    if (!Array.prototype.filter) {
        Array.prototype.filter = function (fun /*, thisp */ ) {
            if (this === null) {
                throw new TypeError();
            }

            var t = Object(this);
            var len = t.length >>> 0;
            if (typeof fun !== "function") {
                throw new TypeError();
            }

            var res = [];
            var thisp = arguments[1];

            for (var i = 0; i < len; i++) {
                if (i in t) {
                    var val = t[i]; // in case fun mutates this
                    if (fun.call(thisp, val, i, t))
                        res.push(val);
                }
            }

            return res;
        };
    }

    /**
     *
     * Template scripts
     *
     **/

    // onDOMLoadedContent event
    jQuery(document).ready(function () {
        // Thickbox use
        jQuery(document).ready(function () {
            if (typeof tb_init !== "undefined") {
                tb_init('div.wp-caption a'); //pass where to apply thickbox
            }
        });
        
        // image overlays
        jQuery.each([
    		'.single .featured-image'
    		], function(i, selector) {
    			jQuery(selector).each(function(j, img) {
    				jQuery(img).addClass('gk-image-wrapper-overlay-wrap');
    				var overlay = new jQuery('<span class="gk-image-wrapper-overlay nohover"></span>');
    				overlay.html('<span></span>'); 
    				jQuery(img).append(overlay);
    			});
    	});
    
    	jQuery.each([
    		'.gk-nsp.overlay .gk-image-link',
    		'.featured-image.category > a'
    	], function(i, selector) {
    		jQuery(selector).each(function(j, img) {
    			jQuery(img).addClass('gk-image-wrapper-overlay-wrap');
    			var overlay = new jQuery('<span class="gk-image-wrapper-overlay"></span>');
    			overlay.html('<span><span></span></span>');
    			jQuery(img).append(overlay);
    		});
    	});
        	
        // style area
        if (jQuery('#gk-style-area')) {
            jQuery('#gk-style-area div').each(function () {
                jQuery(this).find('a').each(function () {
                    jQuery(this).click(function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        changeStyle(jQuery(this).attr('href').replace('#', ''));
                    });
                });
            });
        }
        // Function to change styles

        function changeStyle(style) {
            var file = $GK_TMPL_URL + '/css/' + style;
            jQuery('head').append('<link rel="stylesheet" href="' + file + '" type="text/css" />');
            jQuery.cookie($GK_TMPL_NAME + '_style', style, {
                expires: 365,
                path: '/'
            });
        }

        // Responsive tables
        jQuery('article section table').each(function (i, table) {
            table = jQuery(table);
            var heads = table.find('thead th');
            var cells = table.find('tbody td');
            var heads_amount = heads.length;
            // if there are the thead cells
            if (heads_amount) {
                var cells_len = cells.length;
                for (var j = 0; j < cells_len; j++) {
                    var head_content = jQuery(heads.get(j % heads_amount)).text();
                    jQuery(cells.get(j)).html('<span class="gk-table-label">' + head_content + '</span>' + jQuery(cells.get(j)).html());
                }
            }
        });
        
        // search
        if(jQuery('#gk-search-btn').length > 0) {
        	jQuery('#gk-search-btn').click(function() {
        		if(jQuery('#gk-search').hasClass('active')) {
        			jQuery('#gk-search').addClass('hide');
        			
        			setTimeout(function() {
        				jQuery('#gk-search').removeClass('active');
        				jQuery('#gk-search').removeClass('hide');
        				jQuery('#gk-search').css('display', 'none');
        			}, 350);
        		} else {
        			jQuery('#gk-search').css('display', 'block');
        			
        			setTimeout(function() {
        				jQuery('#gk-search').addClass('active');
        			}, 50);
        		}
        	});
        }
        
        // cart
        if(jQuery('#btn-cart').length > 0) {
        	jQuery('#btn-cart').click(function(e) {
        		e.preventDefault();
        		e.stopPropagation();
        		if(jQuery('#gk-popup-cart').hasClass('active')) {
        			jQuery('#gk-popup-cart').addClass('hide');
        			
        			setTimeout(function() {
        				jQuery('#gk-popup-cart').removeClass('active');
        				jQuery('#gk-popup-cart').removeClass('hide');
        				jQuery('#gk-popup-cart').css('display', 'none');
        			}, 350);
        		} else {
        			jQuery('#gk-popup-cart').css('display', 'block');
        			
        			setTimeout(function() {
        				jQuery('#gk-popup-cart').addClass('active');
        			}, 350);
        		}
        		
        		jQuery('#btn-cart').addClass('loading');
        		setTimeout(function () {
        		    jQuery('#btn-cart').removeClass('loading');
        		}, 500);
        	});
        }
		
		// login popup
        if (jQuery('#gk-popup-login').length > 0 ) {
            // login popup
            var popup_overlay = jQuery('#gk-popup-overlay');
            popup_overlay.css({
                'display': 'none',
                'opacity': 0
            });
            popup_overlay.fadeOut();

            jQuery('#gk-popup-login').css({
                'display': 'none',
                'opacity': 0
            });
            var opened_popup = null;
            var popup_login = null;
            var popup_cart = null;

            if (jQuery('#gk-popup-login').length > 0) {
                popup_login = jQuery('#gk-popup-login');

                jQuery('.gk-login').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    popup_overlay.css('height', jQuery('body').height() + 32);
                    popup_login.css('display', 'block');
                    popup_login.css('opacity', 0);
                    popup_overlay.css('opacity', 0);
                    popup_overlay.css('display', 'block');
                    popup_overlay.animate({
                        'opacity': 0.45
                    });

                    setTimeout(function () {
                        popup_login.animate({
                            'opacity': 1,
                            'margin-top': 0
                        }, 200, 'swing');
                        opened_popup = 'login';
                    }, 300);
                });
            }

            popup_overlay.click(function () {
                if (opened_popup === 'login') {
                    popup_overlay.fadeOut('slow');
                    popup_login.animate({
                        'opacity': 0,
                        'margin-top': -50
                    }, 500, function () {
                        popup_login.css('display', 'none');
                    });
                }

            });

            jQuery('.gk-popup-wrap').each(function (i, wrap) {
                wrap = jQuery(wrap);
                if (wrap.find('.gk-icon-cross')) {
                    wrap.find('.gk-icon-cross').click(function () {
                        popup_overlay.trigger('click');
                    });
                }
            });
        }
                
    });
    
     // GK Image Show
     jQuery(window).load(function(){
             setTimeout(function() {
                 jQuery(".gk-is-wrapper-gk-storefront").each(function(i, el){
                     var wrapper = jQuery(el);
                     var $G = [];
                     var slides = [];
                     var links = [];
                     var imagesToLoad = [];
                     var loadedImages = [];
                     var swipe_min_move = 30;
                     var swipe_max_time = 500;
                     // animation variables
                     $G['animation_timer'] = false;
                     $G['anim_speed'] = wrapper.attr('data-speed');
                     $G['anim_interval'] = wrapper.attr('data-interval');
                     $G['autoanim'] = wrapper.attr('data-autoanim');
                     // blank flag
                     $G['blank'] = false;
                     // load the images
                     wrapper.find('figure').each(function(i, el){
                         el = jQuery(el);
                         var newImg = jQuery('<img title="' + el.attr('data-title') + '" class="gk-is-slide" style="z-index: ' + el.attr('data-zindex') + ';" src="'+ el.attr('data-url') + '" />');
                         links[i] = el.attr('data-link');
                         imagesToLoad.push(newImg);
                         el.prepend(newImg);
                     });
                     //
                     imagesToLoad.forEach(function(item, i) {
                         loadedImages.push(false);
                     });
                     //
                     var time = setInterval(function(){
                         var process = 0;                
                         jQuery(imagesToLoad).each(function(i, elm){
                             elm = jQuery(elm);
                             
                             if(elm[0].complete && !loadedImages[i]) {
                             	var wrap = elm.parent();
                                 var newImgLayer = jQuery('<div title="' + elm.attr('title') + '" class="gk-is-slide" style="z-index: ' + elm.attr('data-zindex') + '; background-image: url(\''+elm.attr('src')+'\');">');
                                 
                                 wrap.prepend(newImgLayer);
                                 
                                 if(i > 0) {
                                     newImgLayer.parent().css('opacity', 0);
                                 }
                             
                         	loadedImages[i] = true;
                             }
                         
                             if(elm[0].complete) {
                         	process++;
                             }
                         });
                         
                         if(process == imagesToLoad.length){
                             clearInterval(time);
                             wrapper.find('img.gk-is-slide').each(function(i, img){
                                  jQuery(img).remove();
                             });
                                             
                             setTimeout(function() {
	                             wrapper.find('.gk-is-preloader').css('position', 'absolute');
	                             wrapper.find('.gk-is-preloader').fadeOut();
	                             wrapper.find('figure').first().css('opacity', 1).fadeIn();
	                             wrapper.find('figure').addClass('active');
	                             wrapper.addClass('loaded');
	         
	                             setTimeout(function() {
	         	    				wrapper.find('figure').first().addClass('activated');
	         	    			}, 50);
	         	    			
	                         }, 400); 
                                     
                             $G['actual_slide'] = 0;
                             
                             wrapper.find('.gk-is-slide').each(function(i, elmt) {
                                 slides[i] = jQuery(elmt);
                             });
             
                             setTimeout(function() {
                                 var initfig = slides[0].parent().find('figcaption');
                                 if (initfig) {
                                 	initfig.css('opacity', 0);
                                     initfig.animate({ opacity: 1 }, 250);
                                 }
                             }, 250);
                             //
                             if (links[i]) {
                                 wrapper.find('.gk-is-slide').click(function(e) {
                                     window.location = links[$G['actual_slide']];
                                 });
                                 wrapper.find('.gk-is-slide').css('cursor', 'pointer');
                             } else {
                                wrapper.find('.gk-is-slide').click(function(e) {
                                     e.preventDefault();
                                 });
                                wrapper.find('.gk-is-slide').css('cursor', 'default');

                             }
                             //
                             wrapper.find('.gk-is-pagination li').each(function(i, item) {
                                 jQuery(item).click(function() {
                                     if (i != $G['actual_slide']) {
                                         $G['blank'] = true;
                                         gk_storefront_autoanimate($G, wrapper, 'next', i);
                                     }
                                 });
                             });           
                             
                             // auto-animation
                             if ($G['autoanim'] == 'on') {
                                 $G['animation_timer'] = setTimeout(function() {
                                     gk_storefront_autoanimate($G, wrapper, 'next', null);
                                 }, $G['anim_interval']);
                             }
                                 
                             // pagination
                             var slide_pos_start_x = 0;
                             var slide_pos_start_y = 0;
                             var slide_time_start = 0;
                             var slide_swipe = false;
     
                             wrapper.bind('touchstart', function (e) {
                                 slide_swipe = true;
                                 var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
     
                                 if (touches.length > 0) {
                                     slide_pos_start_x = touches[0].pageX;
                                     slide_pos_start_y = touches[0].pageY;
                                     slide_time_start = new Date().getTime();
                                 }
                             });
     
                             wrapper.bind('touchmove', function (e) {
                                 var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
     
                                 if (touches.length > 0 && slide_swipe) {
                                     if (
                                         Math.abs(touches[0].pageX - slide_pos_start_x) > Math.abs(touches[0].pageY - slide_pos_start_y)
                                     ) {
                                         e.preventDefault();
                                     } else {
                                         slide_swipe = false;
                                     }
                                 }
                             });
     
                             wrapper.bind('touchend', function (e) {
                                 var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
     
                                 if (touches.length > 0 && slide_swipe) {
                                     if (
                                         Math.abs(touches[0].pageX - slide_pos_start_x) >= swipe_min_move &&
                                         new Date().getTime() - slide_time_start <= swipe_max_time
                                     ) {
                                         if (touches[0].pageX - slide_pos_start_x > 0) {
                                             $G.blank = true;
                                             gk_storefront_autoanimate($G, wrapper, 'prev', null);
                                         } else {
                                             $G.blank = true;
                                             gk_storefront_autoanimate($G, wrapper, 'next', null);
                                         }
                                     }
                                 }
                             });
                         }
                     }, 500);
                 });
         }, 1000);
     });
     
     var gk_storefront_animate = function($G, wrapper, imgPrev, imgNext) {
         var prevfig = jQuery(imgPrev).find('figcaption');
         //
         if (prevfig) {
             prevfig.css('opacity', 1);
             prevfig.animate({
                 opacity: 0
             }, 250);
         }
         //
         jQuery(imgNext).attr('class', 'animated');
     
         jQuery(imgPrev).animate({
             opacity: 0
         }, $G['anim_speed'], function() {
             jQuery(imgPrev).attr('class', '');
         });
      	
      	jQuery(imgNext).animate({
             opacity: 1
         }, $G['anim_speed'], function() {
             jQuery(imgNext).attr('class', 'active');
             var nextfig = jQuery(imgNext).find('figcaption');
             
     		setTimeout(function() {
     			jQuery(imgNext).attr('class', 'active activated');
     		}, 50);
             
             if (nextfig) {
                 nextfig.css('opacity', 0);
                 nextfig.animate({
                     opacity: 1
                 }, 250);
             }
             if ($G['autoanim'] == 'on') {
                 clearTimeout($G['animation_timer']);
     
                 $G['animation_timer'] = setTimeout(function() {
                     if ($G['blank']) {
                         $G['blank'] = false;
                         clearTimeout($G['animation_timer']);
     
                         $G['animation_timer'] = setTimeout(function() {
                             gk_storefront_autoanimate($G, wrapper, 'next', null);
                         }, $G['anim_interval']);
                     } else {
                         gk_storefront_autoanimate($G, wrapper, 'next', null);
                     }
                 }, $G['anim_interval']);
             }
         });
     };
     
     var gk_storefront_autoanimate = function($G, wrapper, dir, next) {
         var i = $G['actual_slide'];
         var imgs = wrapper.find('figure');
     
         if (next == null) {
             next = (dir == 'next') ? ((i < imgs.length - 1) ? i + 1: 0) : ((i == 0) ? imgs.length - 1: i - 1);
             // dir: next|prev
             }
     
         gk_storefront_animate($G, wrapper, imgs[i], imgs[next]);
         $G['actual_slide'] = next;
     
         wrapper.find('.gk-is-pagination li').removeClass('active');
         wrapper.find('.gk-is-pagination li').eq(next).addClass('active');
     };
     
    // GK Tabs
    jQuery(window).load(function () {
        jQuery(document).find('.gk-tabs').each(function (i, el) {
            el = jQuery(el);
            var animation_speed = el.attr('data-speed');
            var animation_interval = el.attr('data-interval');
            var autoanim = el.attr('data-autoanim');
            var eventActivator = el.attr('data-event');
            var active_tab = 0;

            var tabs = el.find('.gk-tabs-item');
            var items = el.find('.gk-tabs-nav li');
            var tabs_wrapper = jQuery(el.find('.gk-tabs-container')[0]);
            var current_tab = active_tab;
            var previous_tab = null;
            var amount = tabs.length;
            var blank = false;
            var falsy_click = false;
            var tabs_h = [];
            //
            jQuery(tabs).css('opacity', 0);
            jQuery(tabs[active_tab]).css({
                'opacity': '1',
                'position': 'relative',
                'z-index': 2
            });

            jQuery(tabs).each(function (i, item) {
                tabs_h[i] = jQuery(item).outerHeight();
            });

            // add events to tabs
            items.each(function (i, item) {
                item = jQuery(item);
                item.bind(eventActivator, function () {
                    if (i !== current_tab) {
                        previous_tab = current_tab;
                        current_tab = i;

                        if (typeof gk_tab_event_trigger !== 'undefined') {
                            gk_tab_event_trigger(current_tab, previous_tab, el.parent().parent().attr('id'));
                        }

                        tabs_wrapper.css('height', tabs_wrapper.outerHeight() + 'px');

                        var previous_tab_animation = {
                            'opacity': 0
                        };
                        var current_tab_animation = {
                            'opacity': 1
                        };
                        //
                        jQuery(tabs[previous_tab]).animate(previous_tab_animation, animation_speed / 2, function () {
                            jQuery(tabs[previous_tab]).css({
                                'position': 'absolute',
                                'top': '0',
                                'z-index': '1'
                            });

                            jQuery(tabs[current_tab]).css({
                                'position': 'relative',
                                'z-index': '2'
                            });

                            jQuery(tabs[previous_tab]).removeClass('active');
                            jQuery(tabs[current_tab]).addClass('active');

                            tabs_wrapper.animate({
                                    "height": tabs_h[i]
                                },
                                animation_speed / 2,
                                function () {
                                    tabs_wrapper.css('height', 'auto');
                                });
                            //
                            setTimeout(function () {
                                // anim
                                jQuery(tabs[current_tab]).animate(current_tab_animation, animation_speed);
                            }, animation_speed / 2);
                        });
                        // common operations for both types of animation
                        if (!falsy_click) {
                            blank = true;
                        } else {
                            falsy_click = false;
                        }
                        jQuery(items[previous_tab]).removeClass('active');
                        jQuery(items[current_tab]).addClass('active');
                    }
                });
            });
            //
            if (autoanim === 'enabled') {
                setInterval(function () {
                    if (!blank) {
                        falsy_click = true;
                        if (current_tab < amount - 1) {
                            jQuery(items[current_tab + 1]).trigger(eventActivator);
                        } else {
                            jQuery(items[0]).trigger(eventActivator);
                        }
                    } else {
                        blank = false;
                    }
                }, animation_interval);
            }
        });
        
        // Magic zoom selectors
    	var main_image = false;
    	var main_image_thumbnail = false;
    	var product_details = false;
    	
    	if(jQuery('.wc-main-image-wrap').length > 0) {
    		main_image = jQuery('.wc-main-image-wrap');
    		main_image_thumbnail = jQuery('.wc-main-image-wrap > a');
    		product_details = jQuery('.product .summary');
    	}
    	
    	
    	if(main_image.length > 0) {
    		var thumbnail = main_image_thumbnail;
    		var gkZoom =  jQuery('<div/>', { id: 'gk-zoom'});
    		
    		var gkPreview = jQuery('<div/>', { id: 'gk-preview'});
    		gkPreview.css({'left': '-99999px'});
    		var gkPreviewSrc = jQuery('<img/>', { src: thumbnail.find('img').attr('src') });
    		
    		if(jQuery('body').width() > jQuery('body').data('tablet-width')) {
    			var gkZoomWidth = parseInt(jQuery('body').data('zoom-size'), 10);
    			var gkZoomHeight = parseInt(jQuery('body').data('zoom-size'), 10); 			
    		} else {
    			var gkZoomWidth = thumbnail.width()/3;
    			var gkZoomHeight = thumbnail.width()/3;
    			var prevSize = product_details.width()/2-20;
    			gkPreview.css({'width': prevSize, 'height' : prevSize});
    		}
    		
    		gkZoom.appendTo(thumbnail);
    		gkPreview.appendTo(jQuery('body'));
    		gkPreviewSrc.appendTo(gkPreview);
    		
    		gkZoom = jQuery('#gk-zoom');
    		gkZoom.css({'width': gkZoomWidth, 'height': gkZoomHeight});
    		
    		var scale = gkPreview.width()/gkZoomWidth;
    	
    		var offset = {};
    		var touch = {};
    		var thumb = {};
    		
    		if(jQuery('body').width() > jQuery('body').data('tablet-width')) {
    			thumbnail.bind({
    				mouseenter: function(){
    				    gkPreviewSrc.attr('src',thumbnail.find('img').attr('src'));
    				    gkPreviewSrc.css({'width': scale*thumbnail.width(), 'height': scale*thumbnail.height()});
    				    gkPreview.addClass('active');
    				    gkZoom = jQuery('#gk-zoom');
    				    gkZoom.addClass('active');
    				    gkPreview.css({'left': thumbnail.offset().left+thumbnail.width()+20, 'top': thumbnail.offset().top});
    				    
    				   
    				},
    				mousemove: function(e){
    					//
    					offset.x = (e.pageX - jQuery(this).offset().left)-gkZoomWidth/2;
    					offset.y = (e.pageY - jQuery(this).offset().top)-gkZoomHeight/2;
    				
    					// validation 
    					if(offset.x < 0) offset.x = 0;
    					if(offset.y < 0) offset.y = 0;
    					if(offset.x > thumbnail.width()-gkZoomWidth) offset.x = thumbnail.width()-gkZoomWidth;
    					if(offset.y > thumbnail.height()-gkZoomHeight) offset.y = thumbnail.height()-gkZoomHeight-3;
    					
    				
    					gkZoom.css({'left' : offset.x, 'top' : offset.y});
    					offset.bx = offset.x*scale;
    					offset.by = offset.y*scale+6;
    					// validation 
    					if(offset.bx < 0) { offset.bx = 0; }
    					if(offset.by < 0) { offset.by = 0; }
    					if(offset.bx > gkPreviewSrc.width()-gkZoomWidth*scale+12*scale) offset.bx = gkPreviewSrc.width()-gkPreview.width();
    					if(offset.by > gkPreviewSrc.height()-gkZoomHeight*scale+12*scale) offset.by = gkPreviewSrc.height()-gkPreview.height();
    					gkPreviewSrc.css({'right': offset.bx, 'bottom' : offset.by});
    				},
    				mouseleave: function() {
    					gkPreview.removeClass('active');
    					gkZoom.removeClass('active');
    				}
    			});
    		} else if(jQuery('body').data('tablet-width') > jQuery('body').width() && jQuery('body').width() > jQuery('body').data('mobile-width')) {
    			thumbnail.bind('touchstart', function(e) {
    				e.preventDefault();
    				e.stopPropagation();
    				gkPreviewSrc.attr('src', thumbnail.find('img').attr('src'));
    				var scale = gkPreview.width()/gkZoomWidth;
    				gkPreviewSrc.css({'width': scale*thumbnail.width(), 'height': scale*thumbnail.height()});
    				gkPreview.addClass('active');
    				gkPreview.css({'left': thumbnail.offset().left+thumbnail.width()+20, 'top': thumbnail.offset().top});
    				gkZoom.addClass('active');
    			});
    			
    			thumbnail.bind('touchmove', function(e) {
    				thumb.x = thumbnail.offset().left;
    				thumb.y = thumbnail.offset().top;
    				
    				
    				
    				var touches = e.originalEvent.changedTouches || e.originalEvent.touches;
    				
    				touch.x = touches[0].pageX;
    				touch.y = touches[0].pageY;
    
    				//
    				if(touch.x > thumb.x && touch.x < thumb.x+thumbnail.width() && touch.y > thumb.y && touch.y < thumb.y+thumbnail.height()) {
    					e.preventDefault();
    					offset.x = (touch.x - thumb.x)-gkZoomWidth/2;
    					offset.y = (touch.y - thumb.y)-gkZoomHeight/2;
    					// validation 
    					if(offset.x < 0) offset.x = 0;
    					if(offset.y < 0) offset.y = 0;
    					if(offset.x > thumbnail.width()-gkZoomWidth) offset.x = thumbnail.width()-gkZoomWidth+12;
    					if(offset.y > thumbnail.height()-gkZoomHeight) offset.y = thumbnail.height()-gkZoomHeight+12;
    					gkZoom.css({'left' : offset.x, 'top' : offset.y});
    					offset.bx = offset.x*scale+6;
    					offset.by = offset.y*scale+6;
    					// validation 
    					if(offset.bx < 0) { offset.bx = 0; }
    					if(offset.by < 0) { offset.by = 0; }
    					if(offset.bx > gkPreviewSrc.width()-gkZoomWidth*scale+12*scale) offset.bx = gkPreviewSrc.width()-gkPreview.width();
    					if(offset.by > gkPreviewSrc.height()-gkZoomHeight*scale+12*scale) offset.by = gkPreviewSrc.height()-gkPreview.height();
    					gkPreviewSrc.css({'right': offset.bx, 'bottom' : offset.by});
    				} 
    			});
    	
    			thumbnail.bind('touchend', function(e) {
    				gkPreview.removeClass('active');
    				gkZoom.removeClass('active');
    			});
    		}
    	}
        
    }); 
})();