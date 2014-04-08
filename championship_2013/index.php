<?php

// 10000 Lakes Regional
// MLM - VisualPulse.net

$_GET['action'] = 'championship_2013';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = $txt['championship_2013'];

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);
  

$matchSchedule = array(
	'Thursday' => array(
		'0' => array(
			'time' => '1:14',
			'time_meridien' => 'PM',
			'alliance' => 'blue',
			'outcome' => '',
		),
		'1' => array(
			'time' => '2:59',
			'time_meridien' => 'PM',
			'alliance' => 'red',
			'outcome' => '',
		),
		'2' => array(
			'time' => '4:58',
			'time_meridien' => 'PM',
			'alliance' => 'red',
			'outcome' => '',
		),
	),
	'Friday' => array(
		'0' => array(
			'time' => '11:01',
			'time_meridien' => 'AM',
			'alliance' => 'red',
			'outcome' => '',
		),
		'1' => array(
			'time' => '1:32',
			'time_meridien' => 'PM',
			'alliance' => 'red',
			'outcome' => '',
		),
		'2' => array(
			'time' => '4:23',
			'time_meridien' => 'PM',
			'alliance' => 'blue',
			'outcome' => '',
		),
		'3' => array(
			'time' => '5:54',
			'time_meridien' => 'PM',
			'alliance' => 'blue',
			'outcome' => '',
		),
	),
	'Saturday' => array(
		'0' => array(
			'time' => '8:57',
			'time_meridien' => 'AM',
			'alliance' => 'blue',
			'outcome' => '',
		),
	),
);
  

echo '
<div class="cat_bar">
	<div class="catbg">
		<div class="cat_bar_title">', $txt['championship_2013'] ,'</div>
	</div>
</div>

<div class="custom_page_under_bar_block">
	We are in the Galileo Division.
	<br />
	You can watch the livestream on <a href="http://www.thebluealliance.com/" target="_blank">The Blue Alliance</a>
</div>

<div>
	<div class="cat_bar">
		<div class="catbg">
			<div class="cat_bar_title">', $txt['2502_match_schedule'] ,'</div>
		</div>
	</div>

	<div class="custom_page_under_bar_block">
		
		<div class="team_match_schedule_entry_holder">
		
';
		foreach($matchSchedule as $key => $day)
		{
			echo '
			<div class="team_match_schedule_day">', $key ,':</div>
			';
			
			foreach($day as $key => $match)
			{
				echo '
				<div class="team_match_schedule_entry">
					<span class="team_match_schedule_entry_time">
						',  $match['time'] ,'
						<span class="team_match_schedule_time_meridien">',  $match['time_meridien'] ,'</span>
					</span>
					<span class="team_match_schedule_entry_alliance ',  $match['alliance'] ,'">', ucfirst( $match['alliance']) ,' Alliance</span>
					<span class="team_match_schedule_entry_outcome">',  $match['outcome'] ,'</span>
				</div>
				';
			}
		}
		
echo '
		</div>
		
		<br />
		<span style="font-size: 10px; font-style: italic;">
			<a href="http://www.usfirst.org/sites/default/files/uploadedFiles/Robotics_Programs/FRC/Events/2013/Galileo_qual_prelim.pdf" target="_blank">Schedule Source</a>
		</span>
		
		
	</div>
	
	
</div>

';






// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>