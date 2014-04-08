<?php

// Homepage
// MLM - VisualPulse.net

$_GET['action'] = 'home';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = 'Team 2502';

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);

$images_array = array(
    array(
        "image" => $settings['images_url'] . '/fader/regional_winners_duluth.png',
        "title" => 'Winning Duluth Regional',
        "link" => '#'
    ),
    array(
        "image" => $settings['images_url'] . '/fader/creative_design_award.png',
        "title" => 'Creative Design Award',
        "link" => '#'
    ),
    array(
        "image" => $settings['images_url'] . '/fader/hc_shirt_shooting.png',
        "title" => 'EP Homecoming 2013',
        "link" => '#'
    ),
    array(
        "image" => $settings['images_url'] . '/fader/entrepreneurship-award.png',
        "title" => 'Entrepreneurship Award',
        "link" => 'http://team2502.com/forums/index.php?topic=234'
    ),
    array(
        "image" => $settings['images_url'] . '/fader/qualified-for-championship.png',
        "title" => 'Now Qualifying for the Championship',
        "link" => 'http://team2502.com/forums/index.php?topic=234'
    )
);
  
?>

<script type="text/javascript">
	$(document).ready(function() {
		// for the faders (like the one on the homepage)
		$('.fader_inner').fader({
			'chic_target'			: '.fader_chicklet_holder',				// What holds the little tokens that shows how many images are and to navigate through them
			'transition_time'		: 1500,										// How long does it take to get from one block to another when transitioning
			'interval'  			: 6000 										// Time before automatic cycle through
		});
});
</script>

<?php

echo '
<div id="homepage_fader_main" class="fader">

	<div class="fader_outer">
		<div class="fader_main bar_outer">
			<div class="fader_holder bar">
				<div class="fader_padding bar_inner">
					<div class="fader_inner fader_mural_here">
						';
						foreach ($images_array as $image) {
							echo '<div class="fader_image_holder" style="background: url(' . $image["image"] . ')" title="' . $image["title"] . '"  href="' . $image["link"] . '"></div>';
						}
						echo '
	
	
						<a class="fader_overlay_link" href="#">
							<div class="fader_overlay">
								<div class="fader_overlay_title">', $images_array[0]['title'] ,'</div>
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
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/garmin.png" alt="Garmin" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/stratasys.png" alt="Stratasys" /></div>
</div>
<div class="homepage_sponsor_holder">
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/emj.png" alt="EMJ" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/emerson.png" alt="Emerson" /></div>
	<div class="homepage_sponsor"><img src="', $settings['images_url'] ,'/2502/sponsors/bluesky.png" alt="Blue Sky Horizon" /></div>
</div>


';






// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>
