<?php

// Homepage
// MLM - VisualPulse.net

$_GET['action'] = 'home';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = 'Team 2502';

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);
  


echo '
<div id="homepage_fader_main" class="fader">

	<div class="fader_outer">
		<div class="fader_main bar_outer">
			<div class="fader_holder bar">
				<div class="fader_padding bar_inner">
					<div class="fader_inner fader_mural_here">
					
						<div class="fader_image_holder" style="background: url(', $settings['images_url'] ,'/fader/gearing_up.png)" title="Gearing Up" href="#"></div>
						<div class="fader_image_holder" style="background: url(', $settings['images_url'] ,'/fader/coding_website.png)" title="Coding..." href="#"></div>
						<div class="fader_image_holder" style="background: url(', $settings['images_url'] ,'/fader/the_build.png)" title="The Build" href="#"></div>
	
	
						<a class="fader_overlay_link" href="http://localhost/2502/forums/index.php">
							<div class="fader_overlay">
								<div class="fader_overlay_title">Gearing Up</div>
							</div>
						</a>
						
						
						<div class="fader_chicklet_container">
							<div class="fader_chicklet_holder">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>

<div class="homepage_sponsor_holder">
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/automation_com.png" alt="Automation.com" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/mts.png" alt="MTS" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/best_buy.png" alt="Best Buy" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/cem.png" alt="Continental Engineering" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/ptc.png" alt="PTC" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/garmin.png" alt="Garmin" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/stratasys.png" alt="Stratasys" /></div>
</div>


';






// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>
