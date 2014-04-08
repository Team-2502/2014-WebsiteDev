$(document).ready(function() {

	$('.heaven_banner').on('click', function () {
		$('.heaven_content').toggle('blind', {}, 500);
	});	
	
	
	
	
	// First check for support then..
	$.support.placeholder = false;
	test = document.createElement('input');
	if('placeholder' in test) $.support.placeholder = true;
	
	// If no placeholder support, lets get some
	if(!$.support.placeholder) {
		var active = document.activeElement;
		$('[type=text], textarea').focus(function () {
			if ($(this).attr('placeholder') != '' && typeof $(this).attr('placeholder') !== 'undefined' && $(this).attr('placeholder') !== false && $(this).val() == $(this).attr('placeholder')) {
				$(this).val('').removeClass('hasPlaceholder');
			}
		}).blur(function () {
			if ($(this).attr('placeholder') != '' && typeof $(this).attr('placeholder') !== 'undefined' && $(this).attr('placeholder') !== false && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
				$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
			}
		});
		
		$('[type=text], textarea').blur();
		$(active).focus();
		$('form').submit(function () {
			$(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
		});
	}

});