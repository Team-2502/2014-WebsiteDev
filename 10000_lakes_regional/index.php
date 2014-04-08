<?php

// 10000 Lakes Regional
// MLM - VisualPulse.net

$_GET['action'] = 'ten_thousand_lakes_regional';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = $txt['ten_thousand_lakes_regional'];

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);
  


echo '
<div class="cat_bar">
	<div class="catbg">
		<div class="cat_bar_title">', $txt['ten_thousand_lakes_regional'] ,'</div>
	</div>
</div>

<div class="custom_page_under_bar_block">
	
</div>

<div style="float: left; width: 48%;">
	<div class="cat_bar">
		<div class="catbg">
			<div class="cat_bar_title">', $txt['2502_match_schedule'] ,'</div>
		</div>
	</div>

	<div class="custom_page_under_bar_block">
		
		<div class="team_match_schedule_entry_holder">
		
			
			<div class="team_match_schedule_day">Friday:</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					9:06
					<span class="team_match_schedule_time_meridien">AM</span>
				</span>
				<span class="team_match_schedule_entry_alliance blue">Blue Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					10:24
					<span class="team_match_schedule_time_meridien">AM</span>
				</span>
				<span class="team_match_schedule_entry_alliance blue">Blue Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					11:24 
					<span class="team_match_schedule_time_meridien">AM</span>
				</span>
				<span class="team_match_schedule_entry_alliance red">Red Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					1:49
					<span class="team_match_schedule_time_meridien">PM</span>
				</span>
				<span class="team_match_schedule_entry_alliance blue">Blue Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					4:02
					<span class="team_match_schedule_time_meridien">PM</span>
				</span>
				<span class="team_match_schedule_entry_alliance blue">Blue Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					5:09
					<span class="team_match_schedule_time_meridien">PM</span>
				</span>
				<span class="team_match_schedule_entry_alliance blue">Blue Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			
			
			
			<div class="team_match_schedule_day">Saturday:</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					9:24
					<span class="team_match_schedule_time_meridien">AM</span>
				</span>
				<span class="team_match_schedule_entry_alliance red">Red Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					10:24
					<span class="team_match_schedule_time_meridien">AM</span>
				</span>
				<span class="team_match_schedule_entry_alliance blue">Blue Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
			<div class="team_match_schedule_entry">
				<span class="team_match_schedule_entry_time">
					11:24
					<span class="team_match_schedule_time_meridien">AM</span>
				</span>
				<span class="team_match_schedule_entry_alliance red">Red Alliance</span>
				<span class="team_match_schedule_entry_outcome"></span>
			</div>
			
		
		</div>
		
		
		
		
		
	</div>
</div>

<div style="float: right; width: 48%;">
	<div class="cat_bar">
		<div class="catbg">
			<div class="cat_bar_title">', $txt['ten_thousand_lakes_regional_official_schedule'] ,'</div>
		</div>
	</div>

	<div class="custom_page_under_bar_block">
	
		<div class="schedule_entry_holder">
		
			
			<div class="schedule_day_title">Thursday:</div>
			<div class="schedule_entry">
				<span class="schedule_time">7:45 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">5 Team Reps Load-In (For Drop Off Only)</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:30 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Pits and Machine Shop open</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:30 <span class="schedule_time_meridien">AM</span> - 12:00 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Registration and inspection</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">12:00 <span class="schedule_time_meridien">PM</span> - 1:00 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Lunch</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">1:00 <span class="schedule_time_meridien">PM</span> - 4:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Practice Rounds</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:00 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Pits and Machine Shop close</span>
			</div>
			
			
			<div class="schedule_day_title">Friday:</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:00 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Pits and Machine Shop open</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:00 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Pits and Machine Shop open</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:30 <span class="schedule_time_meridien">AM</span> - 9:00 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Opening ceremonies</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">9:00 <span class="schedule_time_meridien">AM</span> - 12:00 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Seeding matches</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">12:00 <span class="schedule_time_meridien">AM</span> - 1:00 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Lunch</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">1:00 <span class="schedule_time_meridien">AM</span> - 5:45 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Seeding matches</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">5:45 <span class="schedule_time_meridien">AM</span> - 6:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Awards ceremony</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">7:00 <span class="schedule_time_meridien">AM</span> </span>
				<span class="schedule_title">Pits and Machine Shop close</span>
			</div>
			
			
			<div class="schedule_day_title">Saturday:</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:00 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Pits and Machine Shop open</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:00 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Pits and Machine Shop open</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">8:30 <span class="schedule_time_meridien">AM</span> - 9:00 <span class="schedule_time_meridien">AM</span></span>
				<span class="schedule_title">Opening ceremonies</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">9:00 <span class="schedule_time_meridien">AM</span> - 12:15 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Seeding matches</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">12:15 <span class="schedule_time_meridien">PM</span> - 12:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Alliance Selections</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">12:30 <span class="schedule_time_meridien">PM</span> - 1:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Lunch</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">1:30 <span class="schedule_time_meridien">PM</span> - 4:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Final rounds</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">4:45 <span class="schedule_time_meridien">PM</span> - 5:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Awards ceremony</span>
			</div>
			<div class="schedule_entry">
				<span class="schedule_time">6:30 <span class="schedule_time_meridien">PM</span></span>
				<span class="schedule_title">Pits close</span>
			</div>
		</div>
	
		<br />
		<span style="font-size: 10px; font-style: italic;">
			<a href="http://www.usfirst.org/uploadedFiles/Robotics_Programs/FRC/Events/2012/2012_MN_Agenda.pdf" target="_blank">Schedule Source</a>
		</span>
	</div>
</div>

<div class="clear"></div>
';






// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>