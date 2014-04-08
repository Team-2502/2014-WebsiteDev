<?php

// About
// MLM - VisualPulse.net

$_GET['action'] = 'for_parents';

// Set the banning active
$ssi_ban = true;

// Path to SSI.php
require('../forums/SSI.php');
writeLog();

// Page title. This will appear in the browser
$context['page_title_html_safe'] = $txt['for_parents_page_title'];

//This is self explanatory
template_header(); 

// Here we define the link tree
$context['linktree'] = array(
	'href' => $scripturl,
);
  

$blocks = array(
	'getinvolved' => array(
		'title' => 'Get Involved',
		'content' => '
			<b>Mentoring</b>
			<br />
			Mentoring is a great way to support the team and get involved. We like to keep an 8:1 ratio of students to mentors in order to maximize supervision and make it easy for students to ask for help. Mentoring requires no experience in engineering or marketing, so please don’t feel intimidates. All we ask is that you are supportive of what we do and help in whichever way you feel you can.
			<br /><br />
			
			<b>Competitions</b>
			<br />
			We are attending two regionals this year: one in Minneapolis, the other is in Duluth. We strongly recommend that parents go to at least one of the competitions. The Minneapolis regional is known as 10,000 Lakes and takes March 28-30th. The Duluth regional is known as Northern Lights and takes place March 7-9th. Since Duluth includes travelling, we reserve extra parent rooms when we make hotel reservations for interested parents. Please contact us soon for information.
			<br /><br />
			
			<b>Snacks</b>
			<br />
			In order to use all of our time efficiently, we try to have food and drinks on hand for our members and mentors. We’ve discovered over the years that parents like bringing in food as a way of showing support, and the students like it too. Bringing in snacks is also a great opportunity to see where we are at in our season and seeing your child at work.
			<br /><br />
			<b>Dropping By</b>
			<br/>
			Our team operates many hours a week. If you’re curious about how we run or what we’re working on, feel free to stop by. We would be happy to explain and show what we’ve been working so hard on.
		',
	),
	'faq' => array(
		'title' => 'FAQ',
		'content' => '
			<div class="question_block">
				<div class="question">Q: When does TalonRobotics operate?</div>

				<div class="answer">We operate all year long, not just during the six-week build season allowed by FIRST after Kickoff. While the build season is our most intense period, due to the nature of having to construct out entire robot from scratch before the end of the six-week season, we also help out as mentors to local FLL and FTC teams during their different build seasons and we also contact many companies raising funding for our next build season.</div>
			</div>
			
			<div class="question_block">
				<div class="question">Q: When is the build season?</div>

				<div class="answer">The season runs from Kickoff to an end date set by FIRST six weeks afterward. For our current 2013 season, Kickoff occurred on January 5 and the build season ends by midnight on February 19.</div>
			</div>
			
			<div class="question_block">
				<div class="question">Q: What does TalonRobotics do?</div>

				<div class="answer">We build robots! Our robot is constructed to compete for the competition revealed at Kickoff, and this year we are trying to build a robot to shoot frisbees. Outside of constructing our robot, we also conduct outreach efforts to spread the influence of FIRST and TalonRobotics. This occurs through our members mentoring FLL and FTC teams, as well as through the distribution of our team newsletter The Sprocket throughout the community. We also contact many local companies to raise funds for our team, and these efforts also provide our members with experience giving presentations.</div>
			</div>
			
			<div class="question_block">
				<div class="question">Q: Do you have programs for younger students?</div>

				<div class="answer">TalonRobotics itself does not offer programs to students not in high school; however, our students also help mentor FIRST Lego League and FIRST Tech Challenge teams at our local elementary and middle schools, and those programs are more tailored for younger students not yet in high school.</div>
			</div>
			
			<div class="question_block">
				<div class="question">Q: Do colleges look for FIRST participation?</div>

				<div class="answer">Of course! FIRST is a great program that your student can participate in and put on their college applications. Many colleges prefer students with some pre-college experience in science, technology, and engineering - especially for students applying for college programs in science and engineering - but they especially want to see that students are dedicated to their extracurricular activities throughout high school. In addition, some colleges offer scholarship opportunities solely to students who participated in FIRST during high school.</div>
			</div>
			
			<div class="question_block">
				<div class="question">Q: How often does TalonRobotics travel?</div>

				<div class="answer">In the past, TalonRobotics has not traveled longer than an hour-long bus ride to Williams Arena at the University of Minnesota for our competition. This year, we are also going to compete in a competition held in Duluth, and although we will not be bringing everyone on the team to that Duluth competition we will be bringing some very dedicated members on a longer bus ride. We will be in Duluth only from the day before the competition there to the last day of the competition.</div>
			</div>	
			
			<div class="question_block">
				<div class="question">Q: I have a daughter interested in TalonRobotics. How many girls are typically present?</div>

				<div class="answer">Although TalonRobotics typically has many more males than females, all are welcome and we strongly encourage your daughter to see if she will enjoy working with us. While it is hard to say what a typical day is like, we estimate that oftentimes there will be perhaps two or three girls present working on our robot.</div>
			</div>
			
			<div class="question_block">
				<div class="question">Q: I don\'t have a background in engineering or marketing. Can I still be a mentor?</div>

				<div class="answer">Of course! Although it is preferred that mentors have some experience with engineering or marketing, oftentimes mentors serve as an adult presence around our members so that we remain compliant with Eden Prairie High School\'s rules for extracurricular activities remaining in the building after school ends.</div>
			</div>
		',
	),
	'youthprograms' => array(
		'title' => 'Youth Programs',
		'content' => '
			<b>Junior FIRST LEGO League</b>
			<br />
			Jr. FLL allows young elementary school kids in kindergarten through 3rd grade to be introduced to FIRST programs with the use of LEGOs. By offering these kids a simple challenge, FIRST inspires students from a young age to explore the possibilities of science and technology without much of the competition present in FLL. The structure of Jr. FLL also strongly encourages participating students do research about the given challenge in order to capture their interest of the possibilities for improving the world they see.
			<br /><br />
			<b>FIRST LEGO League</b>
			<br />
			FIRST Lego League divides their competition into different leagues, allowing students in elementary through middle school (specifically 4th-8th grade) to compete with Lego parts in a fun environment. Through the use of LEGOs, FLL students learn about the basics of engineering competitive robots while also learning the basics of how to program their robot to operate. FIRST teaches students about the importance of testing their designs to determine which one seems best suited to the challenge. FLL also provides a means for students to begin applying math and science concepts they learn in school towards constructing a better robot.
			<br /><br />
			To find out how to get involved in an Eden Prairie FLL team, visit: <a href="https://sites.google.com/site/epfirstlegoleague/">https://sites.google.com/site/epfirstlegoleague/</a>
			<br /><br />
			<b>FIRST Tech Challenge</b>
			<br />
			FIRST Tech Challenge provides a stepping stone between the simplicity of FLL and the intensity of FIRST Robotics Challenge by utilizing a set of parts similar to those typically found in FRC while allowing for the many redesigns and extended build season provided by FLL. With FTC, students in 7th-12th grade progress from the simple Lego parts used for robots built in FLL towards materials more typically utilized in the real world for construction, and they also learn more about the importance of working with others to solve problems.
			<br /><br />
			To find out how to get involved in FTC at Eden Prairie Central Middle School, contact your middle schooler’s science teacher.
		',
	),
	
);


if(!$context['user']['is_guest'])
{

	/*
	$blocks['duluthinfo']  = array(
		'title' => 'Duluth',
		'content' => '
			This year, we have the pleasure of participating in two regionals--one of them being Northern Lights in Duluth. It will be a great opportunity to meet new teams and expand as a whole. We are super excited for the new experience and hope parents can join us!
			<br /><br />
			Keep updated on the tournament by watching the live-stream here (www.thebluealliance.com/) or downloading the smartphone app, FRC Spyder,on your phone. (https://play.google.com/store/apps/details?id=com.dwabtech.frcspyder&hl=en)
			<br /><br />
			If you would like to take your son or daughter out to dinner, visit relatives, etc., you MUST let a mentor know via email or phone WELL ahead of time.
			<br /><br />
			The arena and the pits are in the DECC:
			Duluth Entertainment Convention Center
			350 Harbor Dr
			Duluth,MN 55802
			<br /><br />
			Our hotel is attached to the DECC by skyway:
			Holiday Inn Duluth-Downtown
			200 West 1st Street
			Duluth, MN 55802
			Front Desk: 1 - 218 - 722 - 1202
			<br /><br />
			We are sharing a Lorenzo coach bus with the Burnsville team (Burnsville Blaze, FRC # 3184) and look forward to meeting them!
			<br /><br />
			A detailed schedule may be found here (attached file) however some highlighted information is below:
			<br /><br />
			<strong>Wednesday, March 6th</strong>
			<br />
			---- Load bus at EPHS Activities\' Entrance at 4:30 pm
			<br />
			---- Depart at 5:00 pm
			<br />
			<strong>Thursday, March 7th</strong>
			<br />
			---- Practice rounds all day
			<br />
			---- Late night pizza dinner
			<br />
			<strong>Friday, March 8th</strong>
			<br />
			---- Qualification rounds all day
			<br />
			---- Robotics social dinner at Grandma\'s Sports Garden at 7:00 pm
			<br />
			<strong>Saturday, March 9th</strong>
			<br />
			---- Last qualification rounds
			<br />
			---- Final rounds = Cool!
			<br />
			---- Awards ceremony 4:30-5:30 pm
			<br />
			---- Team dinner with Burnsville in the upper part of Little Angie\'s at 6:30 pm (adults welcome!)
			<br />
			---- Estimated arrival time at EPHS is 11:00 pm
			
			<br /><br />

			We will try to keep you updated through email on our estimated arrival time throughout Saturday night.
			<br /><br />
			Please note that all student participants must follow all policies and regulations of the Minnesota State High School League and Eden Prairie High School. There must be NO possession or use of tobacco products, alcohol, or other drugs. There must be NO activity in violation of local law. There will be NO bodily alterations on the trip (i.e. piercings, tattoos, etc.). Violators of any of these guidelines will be sent home at the cost of the parents. Also, any misuse or damage of hotel property will be paid for and shared by all the occupants of the room, unless one person is clearly responsible or admits to the incident.
		
		',
	);
	*/
	
	
}


echo '<div style="display: none;"><pre>';
print_r($blocks);
echo '</div></pre>';



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
		<div class="cat_bar_title">', $txt['for_parents'] ,'</div>
	</div>
</div>

<div class="custom_page_under_bar_block">
	<div class="left_menu_holder">
';
		$i = 0;
		foreach($blocks as $key => $block)
		{
			echo '
			<div class="left_menu_block ', isset($_GET['tab']) ?  (($_GET['tab'] == $key) ? 'active' : '') : (($i == 0) ? 'active' : '')  ,'" data-blockPointer="', $key ,'">', $block['title'] ,'</div>
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
			<div class="right_content_block ', isset($_GET['tab']) ?  (($_GET['tab'] == $key) ? 'active' : '') : (($i == 0) ? 'active' : '')  ,'" data-blockSlug="', $key ,'">
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