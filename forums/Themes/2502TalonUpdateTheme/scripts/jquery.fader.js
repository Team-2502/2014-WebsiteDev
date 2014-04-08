/*
 * jQuery Fader Plugin
 * Copyright (c) MLM from VisualPulse.net
 * Tested: jQuery v1.6.4
*/

(function($){

 $.fn.fader = function(options) {
 
	// Define the default settings
	defaults = {
		'image_holder_target'	: '.fader_inner',							// What holds all of the things you want to cycle through?
		'image_target'			: '.fader_image_holder',					// What are the things we are switching
		'link_class'			: 'fader_link',								// What class do you want on the links?
		'forward_arrow' 		: '.fader_arrow_right', 					// What token / thing makes it move forward
		'backward_arrow'     	: '.fader_arrow_left', 						// What token / thing makes it move backwards
		'overlay_target'		: '.fader_overlay',							// What is holding the info overlay thing
		'overlay_title_t'		: '.fader_overlay_title',					// What element holds the text of the image title
		'overlay_descript_t'	: '.fader_overlay_description',				// What element holds the text the image description
		'overlay_link_target'	: '.fader_overlay_link',					// What element holds the link to link the overlay?
		'chic_target'			: '.fader_chicklet_container',				// What holds the little tokens that shows how many images are and to navigate through them
		'chic_class' 			: 'fader_chicklet',							// NO DOT: What class should we use as a un-selected chicklet
		'chic_class_selected'	: 'fader_chicklet_selected',				// What class should we use as a selected chicklet
		'transition_time'		: 1500,										// How long does it take to get from one block to another when transitioning
		'pos'					: 1,										// What block are we on starting at 1 as in the first child / element
		'interval'  			: 3000 										// Time before automatic cycle through
    };
	
 	
 
	return this.each(function() {
		// Only do this stuff if the target id exists because we do not want pages without the id to run the fader code stuff (waste of resources)
		if($(this).length != 0)
		{
			// If options exist, lets merge them with our default settings
			options = $.extend(defaults, options);
			
			// We need to create the chicklets and fix the z-index
			total_blocks = 0;
			block_id = 1;
			$(options.image_holder_target + ' ' + options.image_target).each(function() {
			
				// Hide them all but the first one
				if(block_id != 1)
				{
					$(this).css('display', 'none');
				}
				
				// Put the chicklet in chicklet target
				$(options.chic_target).append('<div class="' + options.chic_class + '" alt="' + block_id + '"></div>');
			
				// Wrap all the images with links
				$(this).wrap('<a class="' + options.link_class + '" href="' + $(this).attr('href') + '" />');
			
				// Add the selected class to the chicklet if this is the current pos
				if(options.pos == block_id)
				{
					$(options.chic_target + ' .' + options.chic_class + ':nth-child(' + block_id + ')').addClass(options.chic_class_selected);
				}
			
				block_id++;
				total_blocks++;
			});
			
			// We go forward every interval unless we are moving manually such as a arrow click or a jump
			fader_interval = setInterval(function() {
				move(false, 'for', options.pos);
			}, options.interval);
			
			// We clicked forward so lets manually set us forward
			$(options.forward_arrow).live('click', function() {
				move(true, 'for', options.pos);
				return false;
			});
			
			// We clicked backward so lets manually set us backward
			$(options.backward_arrow).live('click', function() {
				move(true, 'back', options.pos);
				return false;
			});
			
			// We clicked a chicklet now so transport us :)
			$(options.chic_target + ' .' + options.chic_class).live('click', function() {
				jump(parseInt($(this).attr('alt')));
			});
			
		}

    });
 
 
 
 	// We are now moving because of an arrow click or its time to move on
	function move(manual, direction, pos)
	{
		if (manual)
		{
			// Stop the interval right away since we are manually moving
			clearInterval(fader_interval);
		}
	
		// set the global position variable
		// We double up on the function because the only difference is how we set the positions..
		if(direction == 'back')
		{
			options.pos = (pos <= 1) ? total_blocks : pos - 1;
			second_pos = (pos <= 1) ? total_blocks : pos - 1;
		}
		else
		{
			options.pos = (total_blocks <= pos) ? 1 : pos + 1;
			second_pos = (total_blocks <= pos) ? 1 : pos + 1;
		}
		
		
		// hide the block that was up
		$(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + pos + ') ' + options.image_target).fadeOut(options.transition_time);
		// show the new block
		$(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + second_pos + ') ' + options.image_target).fadeIn(options.transition_time);
		
		// Highlight chicklet and Change the Overlay
		change_block(second_pos, pos);
		
		if (manual)
		{
			// Now re-instate the interval so it moves on.
			fader_interval = setInterval(function() {
				move(false, 'for', options.pos);
			}, options.interval);
		}

	}
	
	// We are jumping to a certain block because one of the chicklets was clicked
	function jump(block_id)
	{
		// Stop the interval right away since we are manually moving
		clearInterval(fader_interval);
	
		// Only do this if we are going to a new block
		if(options.pos != block_id)
		{
			// hide the block that was up
			$(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + options.pos + ') ' + options.image_target).fadeOut(options.transition_time);
		
			// show the new block
			$(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + block_id + ') ' + options.image_target).fadeIn(options.transition_time);

			// Highlight chicklet and Change the Overlay
			change_block(block_id, options.pos);
			
			// set the pos to what we clicked
			options.pos = parseInt(block_id);
			
		}
		
		
		// Now re-instate the interval so it moves on.
		fader_interval = setInterval(function() {
			move(false, 'for', options.pos);
		}, options.interval);
	}
	
	function change_block(block_pos, before_block_pos)
	{
		// Highlight the correct chicklet
		$(options.chic_target + ' .' + options.chic_class + ':nth-child(' + block_pos + ')').addClass(options.chic_class_selected);
		
		// Un-Highlight the chicklet before
		$(options.chic_target + ' .' + options.chic_class + ':nth-child(' + before_block_pos + ')').removeClass(options.chic_class_selected);
		
		// Now we work on the overlay
		// hide the overlay
		$(options.overlay_target).stop().animate({
			left: -$(options.overlay_target).outerWidth()
		}, {
			duration: options.transition_time / 2,
			queue: false,
			complete: function() { 
				// We change the content while its hidden
				// First the title
				$(options.overlay_target + ' ' + options.overlay_title_t).html($(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + block_pos + ') ' + options.image_target).attr('title'));
				// Now description
				$(options.overlay_target + ' ' + options.overlay_descript_t).html($(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + block_pos + ') ' + options.image_target).attr('alt'));
				// And Link :)
				$(options.overlay_link_target).attr('href', $(options.image_holder_target + ' .' + options.link_class + ':nth-child(' + block_pos + ') ' + options.image_target).attr('href'));
				
				
				// Now Show the overlay
				$(options.overlay_target).animate({
					left: 0
				}, {
					duration: options.transition_time / 2,
					queue: false
				});

			} 
		});
	}
 
 
 
 
};


})(jQuery);