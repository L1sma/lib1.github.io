/*

	1 - MENU PRIMARY

		1.1 - Add class: hasUl
		1.2 - Action by hover
		1.3 - Action by click on iPad
		1.4 - 3rd level margin
		1.5 - Responsive menu: General
		1.6 - Responsive menu: Toggle
		1.7 - Responsive menu: Open sub-levels by click
		1.8 - Support for default WP menu

	2 - MENU SECONDARY

		2.1 - Action by hover
		2.2 - 3rd level margin

	3 - MENU CUSTOM

		3.1 - Span sunbline
		3.2 - Span arrow
		3.3 - Current the class
		3.4 - Action by click

	4 - MEGAMENU

		4.1 - Megamenu
		4.2 - Menu icons
		4.3 - Menu columns

	5 - THEME RELATED

		5.1 - Related posts
		5.2 - Author info expand
		5.3 - Owl slider (sticky)
		5.4 - Owl slider (most viewed)
		5.5 - Responsive top bar: Logo
		5.6 - Responsive top bar: On\Off
		5.7 - Sticked menu
		5.8 - Page transition
		5.9 - Visible the function
		5.10 - Prev-Next posts

	6 - COMMON

		6.1 - Detect browser name
		6.2 - Dinamic styles holder
		6.3 - Quick reply form
		6.4 - Textarea autoresize
		6.5 - Tag cloud
		6.6 - Archives widget span
		6.7 - Image original side
		6.8 - Max size for YouTube & Vimeo video
		6.9 - ST Gallery
		6.10 - Additional bar
		6.11 - BuddyPress fixes
		6.12 - For IE only
		6.13 - WooCommerce
		6.14 - Webkit fixes
		6.15 - Comment tabs

	7 - SESSIONS & INTERVALS

		7.1 - Set content holder width
		7.2 - Set current scroll

	8 - ACTIONS BY LOADING

		8.1 - Flickr widget 150px thumbnails
		8.2 - Scroll to top button
		8.3 - Keep content within box
		8.4 - Sticked sidebars

*/

/* jshint -W099 */
/* global jQuery:false */

var birdhouse = jQuery.noConflict();

birdhouse(function(){

	'use strict';

/*==1.===========================================

	M E N U   P R I M A R Y
	Primary menu on header

===============================================*/

	/*-------------------------------------------
		1.1 - Add class: hasUl
	-------------------------------------------*/

	//birdhouse('.menu li:has(ul), .menu-2 li:has(ul)').addClass('hasUl').find('ul:not(.st-mega-holder)').addClass('sub-menu');
	birdhouse('.menu li:not(.st-megamenu-sidebar):has(ul), #header-holder .menu li.st-megamenu-sidebar, .menu-2 li:not(.st-megamenu-sidebar):has(ul), #header-holder .menu-2 li.st-megamenu-sidebar').addClass('hasUl');
	birdhouse('.menu > li:not(.st-megamenu-sidebar), .menu-2 > li:not(.st-megamenu-sidebar)').each(function(){

		birdhouse('li:has(ul), li:has(ul)',this).find('ul').addClass('sub-menu');

	});


	/*-------------------------------------------
		1.2 - Action by hover
	-------------------------------------------*/

	birdhouse('.menu li:has(ul), .menu-2 li:has(ul)')

		.hover(

			function(){
				if ( sessionStorage.getItem( 'st_content_holder_width' ) > 935 ) {
					birdhouse(this).addClass('hover-has-ul');
				}
			},

			function(){
				birdhouse(this).removeClass('hover-has-ul');
			}

		);


	/*-------------------------------------------
		1.3 - Action by click on iPad
	-------------------------------------------*/

	birdhouse('.menu li:has(ul) > a, .menu-2 li:has(ul) > a')

		.toggle(

			function(){
				if ( sessionStorage.getItem( 'st_content_holder_width' ) < 936 ) {
					birdhouse(this).parent().addClass('hover-has-ul');
					return false;
				}
				else {
					window.location.href = birdhouse(this).attr('href');
				}
			},

			function(){
				if ( sessionStorage.getItem( 'st_content_holder_width' ) < 936 ) {
					birdhouse(this).parent().removeClass('hover-has-ul');
					return false;
				}
				else {
					window.location.href = birdhouse(this).attr('href');
				}
			}

		);


	/*-------------------------------------------
		1.4 - 3rd level margin
	-------------------------------------------*/

		birdhouse('.menu li:not(.st-megamenu-sidebar) ul li:has(ul), .menu-2 li:not(.st-megamenu-sidebar) ul li:has(ul)')
	
			.hover(function(){

				var t = birdhouse(this).height() + 5;

				birdhouse('ul',this).css({margin: '-' + t + 'px 0 0 0'});

			});


	/*-------------------------------------------
		1.5 - Responsive menu: General
	-------------------------------------------*/

	var	st_resp_menu = {};
		st_resp_menu.menu_1 = birdhouse('#menu .menu').html() !== undefined ? birdhouse('#menu .menu').html() : '';
		st_resp_menu.menu_2 = birdhouse('#menu-2 .menu-2').html() !== undefined ? birdhouse('#menu-2 .menu-2').html() : '';

		birdhouse('body').append('<div id="menu-resp-holder"><ul>' + st_resp_menu.menu_1 + st_resp_menu.menu_2 + '</ul></div>');
		birdhouse('#menu-resp-holder > ul > li.hasUl').append('<span>&nbsp;</span>');

		birdhouse('#menu-resp-holder .st-megamenu-sidebar .st-mega-holder',this).next().remove();
		birdhouse('#menu-resp-holder .st-megamenu-sidebar .st-mega-holder',this).remove();


	/*-------------------------------------------
		1.6 - Responsive menu: Toggle
	-------------------------------------------*/

	birdhouse('#menu-resp-button').toggle(
		function() {
	
			birdhouse('body').addClass('menu-resp-on').css( 'overflow-x', 'hidden' );
			//birdhouse('html, body').animate({ scrollTop: 0 }, 1000 );
	
		},
		function() {
	
			birdhouse('body').removeClass('menu-resp-on');
			setTimeout( function(){ birdhouse('body').css( 'overflow-x', 'visible' ); }, 500 );
	
		}
	);


	/*-------------------------------------------
		1.7 - Responsive menu: Open sub-levels by click
	-------------------------------------------*/

	birdhouse('body').on( 'click tap', '#menu-resp-holder > ul > li > span', function(){

		var
			parent = birdhouse(this).parent();

			if ( parent.hasClass('stCurrent') ) {

				parent.removeClass('stCurrent');

			}

			else {

				parent.addClass('stCurrent');

			}

	});


	/*-------------------------------------------
		1.8 - Support for default WP menu
	-------------------------------------------*/

	birdhouse('#menu-box ul.children, #menu-box-2 ul.children').addClass('sub-menu');



/*==2.===========================================

	M E N U   S E C O N D A R Y
	Secondary menu on header

===============================================*/

	// Same as Primary menu


/*==3.===========================================

	M E N U   C U S T O M
	Standard widget

===============================================*/

	/*-------------------------------------------
		3.1 - Span sunbline
	-------------------------------------------*/

	birdhouse('.widget_custom_menu > li > a, .widget_custom_menu > li > ul > li > a').each(function(){

		var
			title = birdhouse(this).attr('title');

			if ( title ) {
				birdhouse(this).append('<span class="subline">' + title + '</span>').removeAttr('title'); }

	});

	/*-------------------------------------------
		3.2 - Span arrow
	-------------------------------------------*/

	birdhouse('.widget_custom_menu > li:has(ul)').append('<span>&nbsp;</span>');


	/*-------------------------------------------
		3.3 - Current the class
	-------------------------------------------*/

	birdhouse('.widget_custom_menu > li.current-menu-ancestor:has(ul)').addClass('stCurrent');


	/*-------------------------------------------
		3.4 - Action by click
	-------------------------------------------*/

	birdhouse('.widget_custom_menu span').click(function(){

		var
			parent = birdhouse(this).parent();

			if ( parent.hasClass('stCurrent') ) {

				parent.removeClass('stCurrent');

			}

			else {

				parent.addClass('stCurrent');

			}

	});


/*==4.===========================================

	M E G A M E N U
	Advanced version of menu

===============================================*/

	/*-------------------------------------------
		4 - Megamenu
	-------------------------------------------*/

	/*- 4.1.3 - Set holder for mega menu
	-------------------------------------------*/

	birdhouse('#header li[class*="st-mega-"]').each(function(){

		if ( !birdhouse('ul',this).length ) {
			birdhouse(this).addClass('hasUl').append('<ul class="st-mega-holder none"><li></li></ul>');
		}


	});

	// Set position by left
	if ( birdhouse('#header').data('st-mega-position') !== 'started' ) {

		if ( birdhouse('#header li[class*="st-mega"]').length ) {
			setInterval( st_mega_position, 1500 ); }

		birdhouse('#header').attr('data-st-mega-position','started');

	}


	/*- 4.1.4 - Define position by left
	-------------------------------------------*/

	function st_mega_position(){
		/*
			If Header 3
		*/
		if ( birdhouse('#header').hasClass('header-3') ) {

			birdhouse('#header li[class*="st-mega-"] > .st-mega-holder, #header li[class*="st-megamenu-"] > .st-mega-holder').each(function(){

				var
					logoWidth = 0,
					liMargin = birdhouse(this).parent().css('margin-left').replace('px','') * 1,
					liPosition = birdhouse(this).parent().position().left * 1,
					liPositionPrevious = birdhouse(this).attr('data-position') * 1;

					if ( Math.floor( logoWidth + liPosition + liMargin ) !== liPositionPrevious ) {

						birdhouse(this).css({ 'transform': 'translate(-' + Math.floor( logoWidth + liPosition + liMargin ) + 'px,0)' }).removeClass('none');

						birdhouse(this).attr( 'data-position', Math.floor( logoWidth + liPosition + liMargin ) );
	
					}

			});

		}

	}

	/*- 4.1.6 - Action by click on iPad
	-------------------------------------------*/

	birdhouse('#header li[class*="st-mega-"] > a')

		.toggle(

			function(){

				if ( sessionStorage.getItem( 'st_content_holder_width' ) < 936 ) {

					birdhouse('#header .hover-has-ul').removeClass('hover-has-ul');

					return false;

				}
				else {

					window.location.href = birdhouse(this).attr('href');

				}

			},

			function(){

				if ( sessionStorage.getItem( 'st_content_holder_width' ) < 936 ) {

					birdhouse(this).parent().removeClass('hover-has-ul');

					return false;

				}
				else {

					window.location.href = birdhouse(this).attr('href');

				}

			}

		);


	/*- 4.1.7 - Pagination
	-------------------------------------------*/

	birdhouse('#header').on( 'click', '.st-mega-nav a', function(){

		// Enable preloader
		birdhouse( '#' + birdhouse(this).data('holder_id') ).addClass('st-mega-loading');

		return false;

	});


	/*-------------------------------------------
		4.2 - Menu icons (must be before Menu columns)
	-------------------------------------------*/

	birdhouse('li[class*="st-ico-menu-"] > a').each(function(){

		var
			a = ( birdhouse(this).parent().attr('class').split('st-ico-menu-')[1] ),
			content = ( a !== undefined ? a.split(' ')[0] : '' );

			birdhouse(this).html( '<i data-content="&#x' + content + ';"><!-- icon --></i>' + birdhouse(this).html() ).addClass('has-st-i');

	});


	/*-------------------------------------------
		4.3 - Menu columns
	-------------------------------------------*/

	birdhouse('#header li[class*="st-menu-col-"]').each(function(){

		birdhouse(this).append('<ul class="st-menu-holder">' + birdhouse(this).children('ul').html() + '</ul>');

	});

	birdhouse('#header ul.st-menu-holder ul, ul.st-menu-holder li').each(function(){

		birdhouse(this).removeAttr('class');

	});

	/*- 4.3.1 - Define position by left
	-------------------------------------------*/

	//if ( birdhouse('#header li[class*="st-menu-col-"]').length ) {
	//	setInterval( st_menu_col_position, 2300 ); }

	function st_menu_col_position(){

		/*
			If Header 2
		*/

		if ( birdhouse('#header').hasClass('header-2') ) {

			birdhouse('#header li[class*="st-menu-col-"] > ul.st-menu-holder').each(function(){
	
				var
					thisWidth = birdhouse(this).width(),
					headerWidth = birdhouse('#header-holder').width(),
					logoWidth = birdhouse('#logo').outerWidth(true),
					liMargin = birdhouse(this).parent().css('margin-left').replace('px','') * 1,
					liPosition = birdhouse(this).parent().position().left * 1,
					liPositionPrevious = birdhouse(this).attr('data-position') * 1;

					// If header-2 sticky
					if ( birdhouse(this).parent().parent().parent().parent().parent().hasClass('menu-fixed') ) {
						logoWidth = 0; }

				var
					thisMax = Math.floor( logoWidth + liPosition + liMargin + thisWidth );

					if ( ( thisMax - headerWidth ) !== liPositionPrevious * 1 ) {

						if ( thisMax > headerWidth ) {
	
							birdhouse(this).css({ 'transform': 'translate(-' + ( thisMax - headerWidth ) + 'px,0)' });
							birdhouse(this).attr( 'data-position', thisMax - headerWidth );
	
						}
	
						else {
	
							birdhouse(this).css({ 'transform': 'translate(0,0)' });
							birdhouse(this).attr( 'data-position', '0' );
	
						}
	
					}
	
			});

		}

		/*
			Else if any Header
		*/

		else {

			birdhouse('#header li[class*="st-menu-col-"] > ul.st-menu-holder').each(function(){
	
				var
					thisWidth = birdhouse(this).width(),
					headerWidth = birdhouse('#header-holder').width(),
					menuPosition = birdhouse(this).parent().parent().css('margin-left').replace('px','') * 1,
					liMargin = birdhouse(this).parent().css('margin-left').replace('px','') * 1,
					liPosition = birdhouse(this).parent().position().left * 1,
					liPositionPrevious = birdhouse(this).attr('data-position') * 1,
					offset = 0;



					if ( birdhouse('#header').hasClass('header-3') && birdhouse(this).parent().parent().hasClass('menu-2') ) {
						offset = 0; }

				var
					thisMax = Math.floor( offset + menuPosition + liPosition + liMargin + thisWidth );

					if ( ( thisMax - headerWidth ) !== liPositionPrevious * 1 ) {

						if ( thisMax > headerWidth ) {
	
							birdhouse(this).css({ 'transform': 'translate(-' + ( thisMax - headerWidth ) + 'px,0)' });
							birdhouse(this).attr( 'data-position', thisMax - headerWidth );
	
						}
	
						else {
	
							birdhouse(this).css({ 'transform': 'translate(0,0)' });
							birdhouse(this).attr( 'data-position', '0' );
	
						}
	
					}
	
			});

		}

	}

	setTimeout( st_menu_col_position, 1200 );
	//st_menu_col_position();
	birdhouse(window).resize( st_menu_col_position );


/*==5.===========================================

	T H E M E   R E L A T E D
	Scritps for certain theme

===============================================*/

	/*-------------------------------------------
		5.2 - Author info expand
	-------------------------------------------*/

	birdhouse('.author .status-content.cutted-closed > div, .page-template-template-authors-php .status-content.cutted-closed > div, .single-author-info .status-content.cutted-closed > div').toggle(function() {

		birdhouse(this).parent().removeClass('cutted-closed').addClass('cutted-opened');

	}, function() {

		birdhouse(this).parent().removeClass('cutted-opened').addClass('cutted-closed');

	});


	/*-------------------------------------------
		5.3 - Owl slider (sticky)
	-------------------------------------------*/

	var owlSticky = birdhouse('#owl-sticky');

	if ( !!birdhouse.prototype.owlCarousel ) { // Does the owlCarousel exist?

		birdhouse(owlSticky).owlCarousel({
	
			autoPlay: birdhouse('#owl-sticky').hasClass('autoplay-on') ? true : false,
			stopOnHover: true,
			slideSpeed: 700,
			pagination: false,
			paginationNumbers: false,
			itemsCustom: [
				[0, 1],
				[574, 1],
				[943, 1],
				[1822, 1],
				[2446, 1]
			],
			afterMove: function(){
				birdhouse('#owl-sticky-tabs div').removeClass('current');
				birdhouse('#owl-sticky-tabs div').eq( this.owl.currentItem ).addClass('current');
			},
			/*jshint unused: true */
			responsiveBaseWidth: '#layout',
		});

		birdhouse('#owl-sticky-tabs').on('click', 'div',
			function(e){
				e.preventDefault();
				owlSticky.trigger( 'owl.goTo', birdhouse(this).data('number') - 1 );
			}
		);

	}

	/* For demo */
	birdhouse('#stBoxed').on( 'click tap', function(){ birdhouse(owlSticky).data('owlCarousel').reinit({ responsiveBaseWidth: '#layout' }); });


	/*-------------------------------------------
		5.5 - Responsive top bar: Logo
	-------------------------------------------*/

	birdhouse('#resp-top-panel').append( birdhouse('#logo > div > div').html() );


	/*-------------------------------------------
		5.6 - Responsive top bar: On\Off
	-------------------------------------------*/

	setInterval( function(){

		if ( sessionStorage.getItem('st_content_holder_width') < 935 && !birdhouse('body').hasClass('menu-resp-on') ) {

			var
				scrollCurrent = birdhouse(window).scrollTop(),
				scrollPrevious = sessionStorage.getItem('st_window_scroll');

				if ( scrollCurrent > scrollPrevious && scrollPrevious > 0 ) {
					birdhouse('#resp-top-panel').addClass('resp-top-panel-off'); }

				if ( scrollCurrent < scrollPrevious ) {
					birdhouse('#resp-top-panel').removeClass('resp-top-panel-off'); }

		}

	}, 301 );


	/*-------------------------------------------
		5.7 - Sticked menu
	-------------------------------------------*/

	/* n/a */


	/*-------------------------------------------
		5.8 - Page transition
	-------------------------------------------*/

	birdhouse('#layout').removeClass('opacity-0');


	/*-------------------------------------------
		5.9 - Visible the function
	-------------------------------------------*/

    var $birdhouse_w = birdhouse(window);
    birdhouse.fn.visible = function( partial, hidden, direction ){

        if (this.length < 1)
            return;

        var $t        = this.length > 1 ? this.eq(0) : this,
            t         = $t.get(0),
            vpWidth   = $birdhouse_w.width(),
            vpHeight  = $birdhouse_w.height(),
            clientSize = hidden === true ? t.offsetWidth * t.offsetHeight : true;
            direction = (direction) ? direction : 'both';

        if (typeof t.getBoundingClientRect === 'function'){

            // Use this native browser method, if available.
            var rec = t.getBoundingClientRect(),
                tViz = rec.top    >= 0 && rec.top    <  vpHeight,
                bViz = rec.bottom >  0 && rec.bottom <= vpHeight,
                lViz = rec.left   >= 0 && rec.left   <  vpWidth,
                rViz = rec.right  >  0 && rec.right  <= vpWidth,
                vVisible   = partial ? tViz || bViz : tViz && bViz,
                hVisible   = partial ? lViz || rViz : lViz && rViz;

            if(direction === 'both')
                return clientSize && vVisible && hVisible;
            else if(direction === 'vertical')
                return clientSize && vVisible;
            else if(direction === 'horizontal')
                return clientSize && hVisible;
        } else {

            var viewTop         = $birdhouse_w.scrollTop(),
                viewBottom      = viewTop + vpHeight,
                viewLeft        = $birdhouse_w.scrollLeft(),
                viewRight       = viewLeft + vpWidth,
                offset          = $t.offset(),
                _top            = offset.top,
                _bottom         = _top + $t.height(),
                _left           = offset.left,
                _right          = _left + $t.width(),
                compareTop      = partial === true ? _bottom : _top,
                compareBottom   = partial === true ? _top : _bottom,
                compareLeft     = partial === true ? _right : _left,
                compareRight    = partial === true ? _left : _right;

            if(direction === 'both')
                return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop)) && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
            else if(direction === 'vertical')
                return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop));
            else if(direction === 'horizontal')
                return !!clientSize && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
        }
    };


	/*-------------------------------------------
		5.10 - Prev-Next posts
	-------------------------------------------*/

	function st_pre_next_post() {

		if ( !birdhouse('#pre_next_post').hasClass('active') ) {
	
			if ( birdhouse('.post-short-info-secondary').visible(true) ) {
		
				birdhouse('#pre_next_post').addClass('active');
		
			}

		}

	}

	if ( birdhouse('#pre_next_post').length ) {
		setInterval( st_pre_next_post, 1111 ); }

	birdhouse( '#pre_next_post' ).on( 'tap click', 'img, span', function() {

		if ( !birdhouse(this).parent().parent().hasClass('active') ) {
			birdhouse('#pre_next_post > div').removeClass('active');
			birdhouse(this).parent().parent().addClass('active');
		}
		else {
			birdhouse(this).parent().parent().removeClass('active');
		}

	});


/*==6.===========================================

 	C O M M O N
	Common scripts

===============================================*/

	/*-------------------------------------------
		6.1 - Detect browser name
	-------------------------------------------*/

	function st_browser(){

		var label = navigator.userAgent.match(/(opera|chrome|safari|firefox(?=\/))\/?\s*(\d+)/i) || [];

		if ( label[1] ) {

			birdhouse('body')

				.removeClass('opera chrome safari gecko') // Flush classes due page cache

				.addClass( label[1] === 'Firefox' ? 'gecko' : label[1].toLowerCase() );

		}

	}

	st_browser();


	/*-------------------------------------------
		6.2 - Holder for dinamic styles
	-------------------------------------------*/

	if ( !birdhouse('#st-dynamic-css').length ) {

		birdhouse('head').append('<style id="st-dynamic-css" type="text/css"></style>');

	}


	/*-------------------------------------------
		6.3 - Quick reply form
	-------------------------------------------*/

		/*- 6.3.1 - Open form
		-------------------------------------------*/
	
		birdhouse('a.quick-reply').click(function(){

	
			/*--- First of all -----------------------------*/
	
			// Make previous Reply link visible
			birdhouse('.quick-reply').removeClass('none');
	
			// Make previous Cancel Reply link hidden
			birdhouse('.quick-reply-cancel').addClass('none');
	
			// Erase all quick holders
			birdhouse('.quick-holder').html('');
	
			// Make comment form visible
			birdhouse('#commentform').removeClass('none');
	
	
			/*--- Append new form -----------------------------*/
	
			var
				id = birdhouse(this).attr('title'),
				form = birdhouse('#respond').html();
	
				// Make this Reply link hidden
				birdhouse(this).addClass('none');
	
				// Make this Cancel Reply link visible
				birdhouse(this).next().removeClass('none');
	
				// Put the form to the holder
				birdhouse('#quick-holder-' + id).append(form).find('h3').remove();
	
				// Set an ID for hidden field
				birdhouse('#quick-holder-' + id + ' input[name="comment_parent"]').val(id);
	
				// Fix placeholders for IE8,9
				if ( birdhouse('body').hasClass('ie8') || birdhouse('body').hasClass('ie9') ) {
					
					birdhouse('.input-text-box input[type="text"], .input-text-box input[type="email"], .input-text-box input[type="url"]', '#quick-holder-' + id).each( function(){ birdhouse(this).val( birdhouse(this).attr('placeholder') ); } );
	
				}

			// Re-define position of sticky bar
			//st_sticky( true );
	
			return false;
	
		});


		/*- 6.3.2 - Cancel reply
		-------------------------------------------*/
	
		birdhouse('.quick-reply-cancel').click(function(){
	
			// Make previous Reply link visible
			birdhouse('.quick-reply').removeClass('none');
	
			// Make this Cancel Reply link hidden
			birdhouse(this).addClass('none');
	
			// Erase all quick holders
			birdhouse('.quick-holder').html('');

			// Re-define position of sticky bar
			//st_sticky( true );

			return false;
	
		});


	/*-------------------------------------------
		6.4 - Textarea autoresize
	-------------------------------------------*/

	birdhouse( 'body' ).on( 'click', 'textarea', function() {
	
		var
			st_textarea = document.querySelector( 'textarea' );
		
			st_textarea.addEventListener( 'keydown', st_textarea_autosize );
	
			function st_textarea_autosize(event) {
				var el = event.currentTarget;
				setTimeout( function(){
					el.style.cssText = 'height: auto;';
					el.style.cssText = 'height:' + ( el.scrollHeight ) + 'px';
				}, 0 );
			}
	
	
	});


	/*-------------------------------------------
		6.5 - Tag cloud
	-------------------------------------------*/

	birdhouse('.tagcloud a').each(function(){

		var
			number = birdhouse(this).attr('title').split(' ');

			number = '<span>' + number[0] + '</span>';

			birdhouse(this).append(number).attr('title','');

	});


	/*-------------------------------------------
		6.6 - Archives widget span
	-------------------------------------------*/

	birdhouse('.widget_archive li, .widget_categories li, .product-categories li').each(function(){

		var
			str = birdhouse(this).html();

			str = str.replace(/\(/g,"<span>");
			str = str.replace(/\)/g,"</span>");
			
			birdhouse(this).html(str);

	});


	/*-------------------------------------------
		6.7 - Image original side
	-------------------------------------------*/

	birdhouse('.size-original').removeAttr('width').removeAttr('height');


	/*-------------------------------------------
		6.8 - Max size for YouTube & Vimeo video
	-------------------------------------------*/

	function st_video_resize(){

		birdhouse('iframe').each(function(){

			var
				src = birdhouse(this).attr('src');

				if ( src ) {

					var
						check_youtube = src.split('youtube.com'),
						check_vimeo = src.split('vimeo.com'),
						check_ted = src.split('ted.com'),
						check_ustream = src.split('ustream.tv'),
						check_metacafe = src.split('metacafe.com'),
						check_rutube = src.split('rutube.ru'),
						check_mailru = src.split('video.mail.ru'),
						check_vk = src.split('vk.com'),
						check_yandex = src.split('video.yandex'),
						check_dailymotion = src.split('dailymotion.com');
		
						if (
							check_youtube[1] ||
							check_vimeo[1] ||
							check_ted[1] ||
							check_ustream[1] ||
							check_metacafe[1] ||
							check_rutube[1] ||
							check_mailru[1] ||
							check_vk[1] ||
							check_yandex[1] ||
							check_dailymotion[1]
							) {
		
								var
									parentWidth = birdhouse(this).parent().width(),
									w = birdhouse(this).attr('width') ? birdhouse(this).attr('width') : 0,
									h = birdhouse(this).attr('height') ? birdhouse(this).attr('height') : 0,
									ratio = h / w,
									height = parentWidth * ratio;
			
									if ( w > 1 ) {
										birdhouse(this).css({ 'width': parentWidth, 'height': height }); }
		
						}

				}

		});

	}

	setTimeout( st_video_resize, 500 );

	birdhouse(window).resize( st_video_resize );

	// BuddyPress
	if ( birdhouse('#buddypress').length ) {
		setInterval( st_video_resize, 3333 ); }


	/*-------------------------------------------
		6.9 - ST Gallery script
	-------------------------------------------*/

	/* none */


	/*-------------------------------------------
		6.10 - Additional bar
	-------------------------------------------*/

	birdhouse('.offset-sidebar-holder-button').click(function(){
		birdhouse('#offset-sidebar-holder').addClass('offset-sidebar-holder-on').find('input').focus();
		return false;
	});

	birdhouse('#offset-sidebar-holder span.close').click(function(){
		birdhouse('#offset-sidebar-holder').removeClass('offset-sidebar-holder-on');
		return false;
	});


	/*-------------------------------------------
		6.11 - BuddyPress fixes
	-------------------------------------------*/

	/* none */
	

	/*-------------------------------------------
		6.12 - IE fixes
	-------------------------------------------*/

	/*
	
		6.12.1 - Quick reply form
		6.12.2 - OnBlur/OnFocus for input fields
		6.12.3 - Dummy Search
		6.12.4 - Dummy Subscribe
	
	*/

	if ( birdhouse('#ie9-detect').length ) { birdhouse('body').addClass('ie9'); }

	if ( birdhouse('body').hasClass('ie8') || birdhouse('body').hasClass('ie9') ) {
	

		/*- 6.12.1 - Append and remove quick form
		===========================================*/
	
		/*
		
			6.12.1 - QUICK REPLY FORM
		
				6.12.1.1 - Remove dummy before submiting
				6.12.1.2 - Return dummy after unsuccess submiting
		
		*/
	
			/*- 6.12.1.1 - Remove a dummy before submitting
			-------------------------------------------*/
		
			birdhouse('#layout')
		
				.on('mousedown tap', '.form-submit input[type="submit"]', function(){
		
					birdhouse(this).parent().parent().find('input[type="text"]')
						.each(function(){
		
							var
								dummy = birdhouse(this).attr('placeholder'),
								val = birdhouse(this).val();
				
								if ( dummy === val ) {
									birdhouse(this).val(''); }
		
						});
		
				});
		
		
			/*- 6.12.1.2 - Return a dummy after unsuccess submitting
			-------------------------------------------*/
		
			birdhouse('body').on('ready mouseenter tap', '#layout', function(){
		
				birdhouse('input[type="text"]',this).each(function(){
		
					var
						dummy = birdhouse(this).attr('placeholder'),
						val = birdhouse(this).val();
		
						if ( !val ) {
							birdhouse(this).val(dummy); }
		
				});
		
			});
	
	
		/*- 6.12.2 - For input fields
		===========================================*/
	
		birdhouse('#layout')
	
			.on('focus', 'input[type="text"]', function(){
	
				var
					dummy = birdhouse(this).attr('placeholder'),
					val = birdhouse(this).val();
	
					if ( dummy === val ) {
						birdhouse(this).val(''); }
	
				})
	
			.on('blur', 'input[type="text"]', function(){
	
				var
					dummy = birdhouse(this).attr('placeholder'),
					val = birdhouse(this).val();
	
					if ( !val ) {
						birdhouse(this).val(dummy); }
	
				});
	
	
		/*- 6.12.3 - Dummy data for search input field
		===========================================*/
	
		birdhouse('.searchform').each(function(){
	
			var
				dummy = birdhouse('input[type="submit"]',this).val();
	
				birdhouse('input[name="s"]',this).val(dummy).attr('placeholder', dummy);
	
		});
	
	
		/*- 6.12.4 - Dummy data for subscribe form
		===========================================*/
	
		birdhouse('.feedemail-input').each(function(){
	
			var
				dummy = birdhouse(this).attr('placeholder');
	
				birdhouse(this).val(dummy);
	
		});


	} // if ( birdhouse('body').hasClass('ie8') || birdhouse('body').hasClass('ie9') )


	/*-------------------------------------------
		6.13 - WooCommerce
	-------------------------------------------*/

	/* none */


	/*-------------------------------------------
		6.15 - Comment tabs
	-------------------------------------------*/

	birdhouse('#tabs-comments span').click( function(){

		if ( !birdhouse(this).hasClass('tab-comments-active') ) {

			birdhouse('#tabs-comments span.tab-comments-active').removeClass('tab-comments-active');
			birdhouse(this).addClass('tab-comments-active');

			if ( birdhouse(this).data('label') === 'respond' ) {

				birdhouse('#respond').removeClass('none');
				birdhouse('#comments').addClass('none');

			}

			else {

				birdhouse('#respond').addClass('none');
				birdhouse('#comments').removeClass('none');

			}


		}

		// Re-define sticky bar
		//st_sticky( true );
	
	});

	// Open comments by loading
	if ( birdhouse('#tabs-comments').length ) {

		var
			st_href = window.location.href.split("#comment-");
	
			if ( st_href.length && st_href[1] ) {
	
				birdhouse('#tabs-comments span.tab-comments-active').removeClass('tab-comments-active').next().addClass('tab-comments-active');
	
				birdhouse('#respond').addClass('none');
				birdhouse('#comments').removeClass('none');
	
				// Re-define sticky bar
				//st_sticky( true );
	
			}

	}


/*==7.===========================================

	S E S S I O N S   &   I N T E R V A L S
	Vary common data

===============================================*/

	/*-------------------------------------------
		7.1 - Set content holder width
	-------------------------------------------*/

	setInterval( function(){ sessionStorage.setItem( 'st_content_holder_width', birdhouse('#content-holder').width() ); }, 1650 );


	/*-------------------------------------------
		7.2 - Set current scroll
	-------------------------------------------*/

	setInterval( function(){ sessionStorage.setItem( 'st_window_scroll', birdhouse(window).scrollTop() ); }, 301 );


});



/*==8.===========================================

	A C T I O N S   B Y   L O A D I N G
	Starts after complete loading

===============================================*/

var pl = jQuery.noConflict();

jQuery(document).ready(function() {

	/*-------------------------------------------
		8.2 - Scroll to top button
	-------------------------------------------*/

	pl('body').append('<div id="scroll-to-top"><!-- Scroll to top --></div>');

	pl('#scroll-to-top').on('click', function(){ pl('html, body').animate({ scrollTop: 0 }, 1000 ); return false; });

	setInterval(function() {

		if ( sessionStorage.getItem( 'st_window_scroll' ) > 1000 ) {
			pl('#scroll-to-top').addClass('scroll-to-top-on'); }

		else {
			pl('#scroll-to-top').removeClass('scroll-to-top-on'); }

	}, 1970 );

});



	/*-------------------------------------------
		8.4 - Sticked sidebars
	-------------------------------------------*/

	(function(pl) {
		pl.fn.st_sticky = function( now ) {
			return this.each(function( now ) {

					var sticky = {};
	
					sticky.master = pl(this).attr('data-master');
					sticky.id = 'st-sticky-' + Math.floor( ( Math.random() * 1000 ) + 1 );
					sticky.adminbar = pl('#wpadminbar').length ? pl('#wpadminbar').height() : 0;
	
				if ( Math.ceil( pl('#' + sticky.master).height() ) < Math.ceil( pl('#' + sticky.id).children().height() ) ) {
					pl('#' + sticky.id).children().css({ 'position': '', 'top': 'auto', 'bottom': 'auto' });
					return;
				}
	
				// Apply ID
				pl(this).attr( 'id', sticky.id );
	
				// Set initial vars
				sessionStorage.setItem( sticky.id, JSON.stringify( sticky ) );
	
				// Set default status
				sessionStorage.setItem( sticky.id + '-status', 'default' );
	
				function st_sticky_do( args ) {

					var
						sticky = JSON.parse( sessionStorage.getItem( args.id ) );
						//scrollCurrent = sessionStorage.getItem( 'st_window_scroll' );
						

					if ( window.outerWidth < 960 ) {

						if ( sessionStorage.getItem( sticky.id + '-status' ) !== 'default' ) {
							pl('#' + sticky.id).css({ 'height': '' });
							pl('#' + sticky.id).children().css({ 'position': '', 'top': 'auto', 'bottom': 'auto' });
							sessionStorage.setItem( sticky.id + '-status', 'default' );
						}

						return;

					}

					var scrollCurrent = pl(window).scrollTop();

					// Now || Init & re-init
					if ( args.now === true || args.init === true ) {
	
						now = false;

						// Reset height
						//pl('#' + sticky.id).css( 'height', '' );
						pl('#' + sticky.master).css( 'height', '' );
	
						if ( args.init !== true ) {
	
							// Reset sidebar position
							pl('#' + sticky.id).children().css({ 'position': 'relative', 'top': '' });
	
						}
	
						// Padding
						sticky.padding = pl('#' + sticky.master).css('paddingTop').replace('px', '');
	
						// Sticky height
						sticky.height = Math.ceil( pl('#' + sticky.id).children().height() );
			
						// Master height
						sticky.master_height = Math.ceil( pl('#' + sticky.master).height() );
			
						// Master top
						sticky.master_top = pl('#' + sticky.master).offset().top;
			
						// Master bottom
						sticky.master_bottom = sticky.master_height * 1 + sticky.master_top * 1;
	
						// Set height to sticky holder
						if ( sticky.height < sticky.master_height && pl('#' + sticky.id).height() !== sticky.master_height ) {
							pl('#' + sticky.id).css( 'height', sticky.master_height );
						}
						if ( sticky.height > sticky.master_height ) {
							if ( sessionStorage.getItem( sticky.id + '-status' ) !== 'default' ) {


								pl('#' + sticky.id).removeAttr('style').children().removeAttr('style');
								sessionStorage.setItem( sticky.id + '-status', 'default' );
							}
						}

						// Save session
						sessionStorage.setItem( sticky.id, JSON.stringify( sticky ) );
	
						// Return
						if ( args.init === true ) {
							return; }
	
					}
	
					// Check if content area is higher than sidebar
					if ( sticky.master_height - sticky.height > 50 ) {
	
						/*--- by default -----------------------------*/
		
						if ( sticky.master_top > scrollCurrent * 1 + sticky.adminbar * 1 ) {
	
							if ( sessionStorage.getItem( sticky.id + '-status' ) !== 'default' ) {
	
								pl('#' + sticky.id).children().css({ 'position': '', 'top': 'auto', 'bottom': 'auto' });
								sessionStorage.setItem( sticky.id + '-status', 'default' );
								//console.log( sessionStorage.getItem( sticky.id + '-status' ) );
								/*console.log(
									'default: if ( sticky.master_top > scrollCurrent + sticky.adminbar ) ' + sticky.master_top + ' > ' + (scrollCurrent * 1 + sticky.adminbar * 1)
								);*/
	
							}
	
						}
		
						/*--- by top -----------------------------*/
		
						else {
		
							if ( sticky.master_top < scrollCurrent * 1 + sticky.adminbar * 1 && sticky.master_bottom > scrollCurrent * 1 + sticky.height * 1 ) {
			
								if ( sessionStorage.getItem( sticky.id + '-status' ) !== 'top' ) {
			
									pl('#' + sticky.id).children().css({ 'position': 'fixed', 'top': sticky.padding * 1 + sticky.adminbar * 1, 'bottom': 'auto' });
									sessionStorage.setItem( sticky.id + '-status', 'top' );
									//console.log( sessionStorage.getItem( sticky.id + '-status' ) );
									/*console.log(
										'top: if ( sticky.master_top < scrollCurrent + sticky.adminbar ) ' + sticky.master_top + ' < ' + (scrollCurrent * 1 + sticky.adminbar * 1)
									);
									console.log(
										'top: if ( sticky.master_bottom > scrollCurrent + sticky.height + ) ' + sticky.master_bottom + ' > ' + (scrollCurrent * 1 + sticky.height * 1 )
									);*/
	
								}
			
							}
		
						}
	
						/*--- by bottom -----------------------------*/
		
						if ( sticky.master_bottom < scrollCurrent * 1 + sticky.height * 1  ) {
	
							if ( sessionStorage.getItem( sticky.id + '-status' ) !== 'bottom' ) {
	
								pl('#' + sticky.id).children().css({ 'position': 'absolute', 'top': 'auto', 'bottom': '0' });
								sessionStorage.setItem( sticky.id + '-status', 'bottom' );
								//console.log( sessionStorage.getItem( sticky.id + '-status' ) );
								/*console.log(
									'bottom: if ( sticky.master_bottom < scrollCurrent + sticky.height ) ' + sticky.master_bottom + ' < ' + ( scrollCurrent * 1 + sticky.height * 1 )
								);*/
	
							}
		
						}
		
					}
	
				}
	
				// Call by initial request + by third-party requests
				if ( now === true ) {
					var args = {};
						args.now = true;
						args.id = sticky.id;
					st_sticky_do( args );
				}
	
				// Major call
				setInterval( function() {
					var args = {};
						args.id = sticky.id;
					st_sticky_do( args );
				}, 100 );
	
				// Re-init
				setInterval( function() {
					var args = {};
						args.id = sticky.id;
						args.init = true;
					st_sticky_do( args );
				}, 350 );
	
				// Reset the sticky because of bug in case fast scrolling to top
				/*setInterval( function(){
					sticky.master_top = pl('#' + sticky.master).offset().top; // Because of underfined
					if ( sticky.master_top > sessionStorage.getItem( 'st_window_scroll' ) * 1 + sticky.adminbar * 1 ) {
						pl('#' + sticky.id).children().css({ 'position': '', 'top': 'auto', 'bottom': 'auto' });
					}
				}, 450);*/

			});
		};
	})(jQuery);

	pl('.st-sticky').st_sticky( true );





