<?php

// About
// MLM - VisualPulse.net

$_GET['action'] = 'about';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = $txt['about_page_title'];

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);
  


$blocks = array(
	'first' => array(
		'title' => 'First',
		'content' => '
			<b>Vision</b>
			<br />
			FIRST was founded with a very specific vision in mind. Originally, this vision was to change the culture of the United States, but today FIRST has teams set up all over the world. FIRST is built around the idea of celebrating science and technology. It wants to see people use those two fields to establish something greater than before rather than relying on them to make life easier.
			<br /><br />
			<b>Mission</b>
			<br />
			FIRST’s mission is first and foremost to inspire youth through a mentor supported system. While the organization may be focused around building STEM (Science, Technology, Engineering, and Math) skills, it also incorporates business, marketing, and much more. It’s also focused around developing other important skills such as confidence, communication, and leadership.
			<br /><br />
			<b>About</b>
			<br />
			FIRST was founded by inventor Dean Kamen in 1989 to advocate greater participation of students in the fields of science, technology, and engineering. FIRST is an acronym representing “For Inspiration and Recognition of Science and Technology” and has become an organization with extensive international influence. It reaches past STEM skills into business and life skills through the team structure and the invention of Coopertition FIRST® and Gracious Professionalism®. Coopertition® emphasizes the idea that in order to compete with each other, people must help each other. One cannot be the best if another, possibly better, team is hindered. Gracious Professionalism® represents a dedication to high-quality work in competing with others, yet simultaneously respecting each other as professionals working towards similar goals.
			<br /><br />
			FIRST helps develop crucial engineering and science skills in students of many ages through its competitively fun and engaging array of Junior FIRST LEGO League, FIRST LEGO League, FIRST Tech Challenge, and FIRST Robotics Competition. In total, these competitions engage students 6 to 18 years of age, the vast majority of which ultimately go to college and study some science or engineering field as a result of their engagement in FIRST.
		',
	),
	'talonrobotics' => array(
		'title' => 'TalonRobotics',
		'content' => '
			<b>Vision</b>
			<br />
			Our vision as a FIRST team is to utilize student leaders to simulate a small business environment where both members and mentors can have fun and learn from each other.
			<br /><br />
			<b>Mission</b>
			<br />
			Our mission as a FIRST team is to show our members they are able to do more than they think they can. We do this by utilizing student-on-student teaching and mentor-on-student support to accomplish many projects throughout the year. While we like to make use of all the experience mentors give us, all decisions are ultimately made by the students.
			<br /><br />
			<b>About</b>
			<br />
			Team 2502 was founded during the 2007-2008 school year by a group of five Eden Prairie High School students interested in building a robot. With very few students and even fewer mentors, they set out to introduce FI¬RST Robotics to Eden Prairie High School and began competing in the FIRST Robotics Competition during the 2008 season as EP Robotics. Since then, team membership has grown every year to an estimated 55 for the 2013 season, and the team is now known as TalonRobotics.
			<br /><br />
			Our team is broken down into various sub-groups lead by student leaders. Members are able to be a part of multiple sub-teams and learn a variety of skills as a result. While many leaders are elected student “captains,” any member willing to step up to the challenge is able to be a “project lead” to help oversee various jobs. While the six week build season remains our team’s most active time of year, team activities are not restricted to those six weeks plus the competition weekends. Our newsletter, The Sprocket, is produced primarily around the build season in parallel with our robot’s construction. Beyond the build season, we actively search for and contact potential sponsors as well as train new members and complete summer projects that are a bit too large to accomplish during the build season. We also help sponsor and provide student mentors for FIRST LEGO League and FIRST Tech Challenge teams in our area.
		',
	),
	'timeline' => array(
		'title' => 'Timeline',
		'content' => '
			<div class="timeline_block">
				<div class="timeline_entry" data-year="2013">
					(2013) This year\'s challenge is called "Ultimate Accent." The challenge involves shooting or throwing Frisbees into rectangular goals with a bonus challenge of climbing a pyramidal tower. Our robot is called Disc-O-bot and shoots Frisbees, has an adjustable shooter, and lifts itself with pneumatics. Most of its functions can be seen here.
				</div>
			</div>
			<div class="timeline_block">
				<div class="timeline_entry" data-year="2012">
					2012\'s challenge was called "Rebound Rumble." The challenge involved picking up foam basketballs from the ground and shooting them into baskets on the far side of the field. In the spirit of basketball, our 2012 robot was called Ricky Robio. It picked up balls from the floor and raised them via a conveyor system to the shooter, from where they could be aimed shot at the hoops via rotating turret.
				</div>
			</div>
			<div class="timeline_block">
				<div class="timeline_entry" data-year="2011">
					2011’s challenge was called <a href="http://www.youtube.com/watch?v=93Tygo0_O5c" target="_blank">"Logomotion."</a> The challenge involved taking inner tubes and hanging them up on pegs to score points.  Our robot used a forklift-style "claw" to hold the inner tube while it traversed the field to hang the tubes up on the scoring rack.  Breaking from past tradition, we did not give a name to our robot for the 2011 season.
				</div>
			</div>
			<div class="timeline_block">
				<div class="timeline_entry" data-year="2010">
					2010’s challenge was called <a href="http://www.youtube.com/watch?v=IEHAj3EmpMw" target="_blank">"Breakaway."</a>  Breakaway was a soccer-like challenge, where each robot had to shoot soccer balls into the other team’s goal. Our robot was called "Simba." Simba used pneumatics to kick the soccer ball, and even to lift itself up!
				</div>
			</div>
			<div class="timeline_block">
				<div class="timeline_entry" data-year="2009">
					2009’s challenge was called <a href="http://www.youtube.com/watch?v=fyER3MrNBZQ" target="_blank">"Lunacy."</a> In lunacy, each robot is required to pick up balls from a slippery surface, and shoot them into other robots. Our robot (known as "Faraday") used pneumatic tubing to pick up balls and to launch them. It also had a <a href="http://www.youtube.com/watch?v=CQWOtCCE_zM" target="_blank">vision tracker</a> along with it! Our robot’s sliding and shooting abilities can be seen <a href="http://www.youtube.com/watch?v=LswdAXDIpsw" target="_blank">here</a>. 
				</div>
			</div>
			<div class="timeline_block">
				<div class="timeline_entry" data-year="2008">
					2008’s challenge was called <a href="http://www.youtube.com/watch?v=4a9KfpBZ4DQ" target="_blank">"Overdrive."</a>  The robot that we made for this competition was the first robot ever built by Team 2502. The main purpose of our robot was to zoom around the arena. In other words, it was built for speed.
				</div>
			</div>
		',
	),
);



echo "
 <script type=\"text/javascript\">
	$(document).ready(function() {
		$('.left_menu_block').live('click', function() {
			var left_menu_block_clicked = $(this);
			
			// Make sure we don't fade in and out if we click the active block
			if($('.left_menu_block.active').attr('data-blockPointer') != $(this).attr('data-blockPointer'))
			{
				$('.right_content_block[data-blockSlug=\"' + $('.left_menu_block.active').attr('data-blockPointer') + '\"]').fadeOut(200, function() { // hide the block in the viewer
					$(this).removeClass('active');
					
					$('.right_content_block[data-blockSlug=\"' +left_menu_block_clicked.attr('data-blockPointer') + '\"]').fadeIn(200, function() { // show the new block
						$(this).addClass('active');
					}); 
					left_menu_block_clicked.addClass('active'); // add the active class to the left menu item
				}); 
				$('.left_menu_block').removeClass('active'); // remove the active class from the menu item
			}
			
		});
		
	});
</script>
";
  
echo '
<div class="cat_bar">
	<div class="catbg">
		<div class="cat_bar_title">', $txt['about'], '</div>
	</div>
</div>

<div class="custom_page_under_bar_block">
	<div class="left_menu_holder">
';
		$i = 0;
		foreach($blocks as $key => $block)
		{
			echo '
			<div class="left_menu_block ', isset($_GET['about']) ?  (($_GET['about'] == $key) ? 'active' : '') : (($i == 0) ? 'active' : '')  ,'" data-blockPointer="', $key ,'">', $block['title'] ,'</div>
			';
			
			$i++;
		}
		
echo '
	</div>
	<div class="right_content_viewer ">
';
		$i = 0;
		foreach($blocks as $key => $block)
		{
			echo '
			<div class="right_content_block ', isset($_GET['about']) ?  (($_GET['about'] == $key) ? 'active' : '') : (($i == 0) ? 'active' : '')  ,'" data-blockSlug="', $key ,'">
				', $block['content'] ,'
			</div>
			';
			
			$i++;
		}
		
echo '
	</div>
	<div class="clear"></div>
</div>

';






// no displayable content should be below the footer...
//This is self explanatory too.		  
template_footer(); 

?>