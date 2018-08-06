;(function(w, $){

	var downarrow = 'images/down.gif' // path to down arrow image
	var fxduration = 300 // transition effect duration in milliseconds
	var showhidedelay = [100,100] // show and hide sub menu delay in milliseconds

	var startingzIndex = 1000
	var detectmobile = /(ipad)|(iphone)|(ipod)|(android)|(webOS)/i.test(navigator.userAgent)
	var transform3d = typeof $(document.documentElement).css('perspective') != "undefined"


	w.efluidmenu = function(setting){
		var $mainmenu = $('#' + setting.menuid)
		var $mainul = $mainmenu.find('ul:eq(0)')
		var $firstli = $mainul.find('li:eq(1)')
		var $mobiletoggle = $mainmenu.find('.efluid-animateddrawer')
		var $lastactiveheader = $()
		var $submenus = $mainul.find('ul')
		var $richsubmenus = $()
		var triggertype = (detectmobile)? 'touchstart' : 'mouseenter'
		// ** mobiletrapevents- trap these events to cancel event bubbling and links from firing across mobile devices
		// ** For certain older mobile devices, preventdefault on touchstart doesn't work
		var mobiletrapevents = 'touchstart click'

		$mainul.data('timers', {})

		$mainul.find('li[rel]').each(function(i){
			var $li = $(this)
			var $richsubmenu = $( '#' + $li.attr('rel') )
			if ($richsubmenu.length == 1){
				var $anchorlinkclone = $li.find('>a:eq(0)').clone(true, false)
				$li.empty().append($anchorlinkclone, $richsubmenu)
				$richsubmenus = $richsubmenus.add($richsubmenu)
			}
		})

		$submenus = $submenus.add($richsubmenus)

		$mainul.on(mobiletrapevents, function(e){
			if ( e.type == 'click' && $mobiletoggle.css('display') == 'block' ){ // in mobile menu mode
				if ( !/(input)|(textarea)/i.test(e.target.tagName) ){
					$mainul.data('timers').hidetimer = setTimeout(function(){
						$mainul.removeClass('openmobileclass')
					}, showhidedelay[1])
				}
			}
			e.stopPropagation() // prevent events from menu UL from bubbling up to BODY level
		})

		$submenus.each(function(i){
			var $submenu = $(this)
			var $header = $submenu.parent('li')

			$submenu.data('width', $submenu.outerWidth())
							.css({animationDuration: fxduration + 'ms', visibility:'visible'})
			$header.find('a:eq(0)').append('<img src="' + downarrow + '" class="downarrow" />')
			$header.data('timers', {})

			if (detectmobile){
				if ( $mobiletoggle.css('display') == 'none' ){ // in "desktop" menu mode
					$header.on(mobiletrapevents, function(e){
						e.preventDefault() // prevent header link from firing across mobile devices when clicked on
					})
				}
			}
			$header.on(triggertype, function(e){
				if ( $mobiletoggle.css('display') == 'none' ){ // in desktop menu mode
					clearTimeout($header.data('timers').hidetimer)
					$header.data('timers').showtimer = setTimeout(function(){
						var firstlioffset = $firstli.offset()
						var headeroffset = $header.offset()
						var distbtwheaders = headeroffset.left - firstlioffset.left
						var submenuleft = 0
						var winrightedge
						var submenuwidth = parseInt($submenu.data('width'))

						$header.addClass('selected')
						if (detectmobile){ // in mobile devices (desktop devices don't plug into click/touchstart events)
							if ( $lastactiveheader.get(0) != $header.get(0) ){ // if user clicks on a different header from last one
								$lastactiveheader.trigger('mouseleave')
							}
							else if ($submenu.css('display') == 'block'){  // if user clicks on same header twice and sub menu is open
								$lastactiveheader.trigger('mouseleave')
								e.preventDefault()
								return							
							}
						}
						$lastactiveheader = $header
	
						if ( distbtwheaders > 0 && submenuwidth > (distbtwheaders + $header.width()) ){ // if enough room to drop down from first LI
							submenuleft = -distbtwheaders
						}
						else{
							winrightedge = $(window).width() + $(window).scrollLeft()
							if ( (headeroffset.left + submenuwidth) > winrightedge ){ // not enough room to drop right?
								submenuleft = -submenuwidth + $header.width()
								if ( (headeroffset.left + submenuleft ) < 0 ){ // not enough room to drop left either?
									submenuleft = Math.min(-distbtwheaders, 0) // drop down from first LI or original header, whichever value is smaller
								}
							}
						}
						$header.css({zIndex: startingzIndex++})

						$submenu.css({left: submenuleft, display:'block'})
						if (transform3d){
							$submenu.removeClass('fade-out-nudge-up-animation')
											.addClass('fade-in-rise-down-animation')
						}
						else{ // fallback animation
							$submenu.css({opacity: 0}).stop().animate({opacity:1}, fxduration)
						}
					}, showhidedelay[0])
					e.preventDefault() // preventdefault on "touchstart" and "mouseleave" depending on device
				} // end if
			}) // end $header.on(triggertype...

 			// close sub menus on desktop PC devices  when user clicks on main header LIs
			// in mobile devices, this is done on $header.on(triggertype)
			if ( !detectmobile && triggertype == 'mouseenter'){ // in desktop device mode
				$header.on('click', function(e){
					$header.trigger('mouseleave', [0])
				})
			}
			$header.on('mouseleave', function(e, overridedelay){
				if ( $mobiletoggle.css('display') == 'none' ){
					clearTimeout($header.data('timers').showtimer)
					$header.data('timers').hidetimer = setTimeout(function(){
						$header.removeClass('selected')
						$submenu.css({zIndex: 0})
						if (transform3d){
							$submenu.removeClass('fade-in-rise-down-animation')
											.addClass('fade-out-nudge-up-animation')
						}
						else{
							$submenu.stop().animate({opacity: 0}, fxduration, function(){
								$(this).css({display:'none'})
							})
						}
					}, (overridedelay != null)? overridedelay : showhidedelay[1])
				} // end if
			})
			if (detectmobile){
				$submenu.on(mobiletrapevents, function(e){
					e.stopPropagation() // stop sub menu links from being disabled due to e.preventDefault() higher up
				})
			}
			$submenu.on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e){
				var $target = $(e.target) // target
				if ($target.hasClass('fade-out-nudge-up-animation')){
					$target.css({display:'none'})
				}
			})
		}) // end each

		$(document).on( (detectmobile)? 'touchstart' : 'click', function(e){
			if ( $mobiletoggle.css('display') == 'none' ){ //in desktop menu mode
				$lastactiveheader.trigger('mouseleave', [0])
			}
			else{ // mobile menu mode
				$mainul.removeClass('openmobileclass')				
			}
		})

		$mobiletoggle.on('click', function(e){
			clearTimeout( $mainul.data('timers').hidetimer )
			$mainul.toggleClass('openmobileclass')
			e.stopPropagation()
		})
		$mobiletoggle.on('touchstart', function(e){
			e.stopPropagation()
		})
	}

})(window, jQuery)

jQuery(function($){ // on DOM lad

	efluidmenu({
		menuid: 'fluidmenu1' // initialize menu with ID 'fluidmenu1'
	})

})