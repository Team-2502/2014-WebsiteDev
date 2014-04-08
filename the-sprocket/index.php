<?php

// The Sprocket
// MLM - VisualPulse.net

$_GET['action'] = 'the_sprocket';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = 'The Sprocket';

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);
  

echo "
<script type=\"text/javascript\">
	$(document).ready(function() {
		$('.sprocket_issue').live('click', function() {
			$('.sprocket_issue').removeClass('active');
			$('.sprocket_pdf_viewer').attr('src', 'http://docs.google.com/gview?url=", $homeurl ,"/the-sprocket/pdf_archive/' + $(this).attr('data-issue') + '.pdf&embedded=true');
			$(this).addClass('active');
		});
		
	});
	</script>

";

echo '
<div class="cat_bar">
	<div class="catbg">
		<div class="cat_bar_title">', $txt['the_sprocket'] ,'</div>
	</div>
</div>

<div class="custom_page_under_bar_block">
	<div class="sprocket_issue_holder">
';

		// Get all the pdf's in the directory
		$pdfs = glob('pdf_archive/*.pdf');
		// Sort them latest to oldest
		$pdfs = array_reverse($pdfs);
		 
		$pdf_names = array();
		// Display each file name
		$is_first = true;
		foreach($pdfs as $pdf)
		{
			$pdf = pathinfo($pdf);
			
			echo '
			<div class="sprocket_issue ', (isset($_GET['issue']) ? (($_GET['issue'] == $pdf['filename']) ? 'active' : '') : (($is_first) ? 'active' : '')) ,'" data-issue="', $pdf['filename'] ,'">
				', date('F j, Y', $pdf['filename']) ,'
			</div>
			';
			
			$pdf_names[] = $pdf['filename'];
			$is_first = false;
		}
	
echo '
	</div>
	
	<div class="sprocket_pdf_viewer_holder">
		<iframe class="sprocket_pdf_viewer" src="http://docs.google.com/gview?url=', $homeurl ,'/the-sprocket/pdf_archive/', (isset($_GET['issue']) && in_array($_GET['issue'], $pdf_names)) ? $_GET['issue'] : $pdf_names[0] ,'.pdf&embedded=true" frameborder="0"></iframe>
	</div>
	
	<div class="clear"></div>
</div>
';






// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>