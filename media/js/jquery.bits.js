$(document).ready(function() {

	
	$('.container').imagesLoaded( function(){
		$('.container').masonry({
			// options
			itemSelector : '.block',
			isAnimated: !Modernizr.csstransitions,
			// set columnWidth a fraction of the container width
			columnWidth: function( containerWidth ) {
				return containerWidth / 5;
			}
		});
	});


    // infinitescroll() is called on the element that surrounds
    // the items you will be loading more of
    /*
    $('.container').infinitescroll({
        navSelector  : ".pagination",
        // selector for the paged navigation (it will be hidden)
        nextSelector : ".pagination-link.active + .pagination-link a",
        // selector for the NEXT link (to page 2)
        itemSelector : ".container .block",
        // selector for all items you'll retrieve
        debug : true
    }, function(arrayOfNewElems) {
        $('.container').masonry( 'appended', $content, isAnimatedFromBottom );
    });
    */
	
	
	function openDialog() {
		Avgrund.show('#default-popup');
	}
	function closeDialog() {
		Avgrund.hide();
	}

	$('.block').on('click', function() {
        if($('.popup_contents', this).length)
        {
            $('.avgrund-popup .avgrund-popup-content').html($('.popup_contents', this).html());
            openDialog();
        }
       else
        {
            console.log('no contents');
        }
	});

	$('.avgrund-popup').on('click', function() {
        // Stop the youtube videos playing
        if($('.avgrund-popup #popup-youtube-player').length)
            $('.avgrund-popup #popup-youtube-player')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');

		closeDialog();
	});



	
});