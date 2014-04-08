<?php


//error_reporting(E_ALL);

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

/*	This template is, perhaps, the most important template in the theme. It
	contains the main template layer that displays the header and footer of
	the forum, namely with main_above and main_below. It also contains the
	menu sub template, which appropriately displays the menu; the init sub
	template, which is there to set the theme up; (init can be missing.) and
	the linktree sub template, which sorts out the link tree.

	The init sub template should load any data and set any hardcoded options.

	The main_above sub template is what is shown above the main content, and
	should contain anything that should be shown up there.

	The main_below sub template, conversely, is shown after the main content.
	It should probably contain the copyright statement and some other things.

	The linktree sub template should display the link tree, using the data
	in the $context['linktree'] variable.

	The menu sub template should display all the relevant buttons the user
	wants and or needs.

	For more information on the templating system, please see the site at:
	http://www.simplemachines.org/
*/

// Initialize the template... mainly little settings.
function template_init()
{
	global $context, $settings, $options, $txt;

	/* Use images from default theme when using templates from the default theme?
		if this is 'always', images from the default theme will be used.
		if this is 'defaults', images from the default theme will only be used with default templates.
		if this is 'never' or isn't set at all, images from the default theme will not be used. */
	$settings['use_default_images'] = 'never';

	/* What document type definition is being used? (for font size and other issues.)
		'xhtml' for an XHTML 1.0 document type definition.
		'html' for an HTML 4.01 document type definition. */
	$settings['doctype'] = 'xhtml';

	/* The version this template/theme is for.
		This should probably be the version of SMF it was created for. */
	$settings['theme_version'] = '2.0';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = true;

	/* Use plain buttons - as opposed to text buttons? */
	$settings['use_buttons'] = true;

	/* Show sticky and lock status separate from topic icons? */
	$settings['separate_sticky_lock'] = true;

	/* Does this theme use the strict doctype? */
	$settings['strict_doctype'] = false;

	/* Does this theme use post previews on the message index? */
	$settings['message_index_preview'] = false;

	/* Set the following variable to true if this theme requires the optional theme strings file to be loaded. */
	$settings['require_theme_strings'] = true;
}

// The main sub template above the content.
function template_html_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"', $context['right_to_left'] ? ' dir="rtl"' : '', '>
<head>';


	// Favicons
	echo '
	<link href="', $settings['images_url'], '/2502/favicon.ico" rel="icon" />
	<!-- [if ! IE] -->
		<link href="', $settings['images_url'], '/2502/favicon.png" rel="shortcut icon" />
	<!-- [endif] -->
	';



	// Tell IE9 to back off because they suck with the filter gradients and rounding them
	echo '
	<!--[if  ie 9]>
	<style type="text/css" media="screen">
		*
		{
			filter: none !important;
		}
	</style>
	<![endif]-->
	';
	
	// The ?fin20 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/index', $context['theme_variant'], '.css?fin20" />';

	// Some browsers need an extra stylesheet due to bugs/compatibility issues.
	foreach (array('ie7', 'ie6', 'webkit') as $cssfix)
		if ($context['browser']['is_' . $cssfix])
			echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/', $cssfix, '.css" />';

	// RTL languages require an additional stylesheet.
	if ($context['right_to_left'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/rtl.css" />';

	// Here comes the JavaScript bits!
	echo '
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/script.js?fin20"></script>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/theme.js?fin20"></script>
	<script type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_default_theme_url = "', $settings['default_theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";', $context['show_pm_popup'] ? '
		var fPmPopup = function ()
		{
			if (confirm("' . $txt['show_personal_messages'] . '"))
				window.open(smf_prepareScriptUrl(smf_scripturl) + "action=pm");
		}
		addLoadEvent(fPmPopup);' : '', '
		var ajax_notification_text = "', $txt['ajax_in_progress'], '";
		var ajax_notification_cancel_text = "', $txt['modify_cancel'], '";
	// ]]></script>';
	
	// My jQuery Stuff
	echo '
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/jquery.fader.js"></script>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/jquery.bits.js"></script>
	';

	echo '
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title_html_safe'], '" />', !empty($context['meta_keywords']) ? '
	<meta name="keywords" content="' . $context['meta_keywords'] . '" />' : '', '
	<title>', $context['page_title_html_safe'], '</title>';

	// Please don't index these Mr Robot.
	if (!empty($context['robot_no_index']))
		echo '
	<meta name="robots" content="noindex" />';

	// Present a canonical url for search engines to prevent duplicate content in their indices.
	if (!empty($context['canonical_url']))
		echo '
	<link rel="canonical" href="', $context['canonical_url'], '" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" />
	<link rel="search" href="', $scripturl, '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']) && (!empty($modSettings['allow_guestAccess']) || $context['user']['is_logged']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name_html_safe'], ' - ', $txt['rss'], '" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="', $scripturl, '?board=', $context['current_board'], '.0" />';

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'];

	echo '
</head>
<body>';
}

function template_body_above()
{
	global $context, $boardurl, $settings, $options, $scripturl, $homeurl, $txt, $modSettings;
	
	/*
	echo '<div style="display: none"><pre>';
	print_r($context);
	echo '</pre></div>';
	*/
	
	/*
	echo '<pre>';
	print_r(parse_url($boardurl));
	echo '</pre>';
	*/
	
	/*
	echo '<pre>';
	print_r($settings);
	echo '</pre>';
	*/
	
	echo '
	<div class="heaven_box">
		<div class="heaven_content">
			<div class="heaven_content_inner" style="', !empty($settings['forum_width']) ? 'width: ' . $settings['forum_width'] : 'width: 1000px;' ,'">
	';
				
				// Use twitter call if they use that setting and have a username in it
				if($modSettings['heaven_box_use_twitter'] && !empty($modSettings['heaven_box_twitter_username']))
				{
					// Feature out of date
					echo 'TODO: use Twitter API v1.1';
				
					/*
					// Call it from the cache
					$tweets = cache_get_data('heaven_box_tweets', 120);
					
					// If cache is null we need to get it
					if ($tweets == null)
					{
						$tweets = twitter_call($modSettings['heaven_box_twitter_username'], $modSettings['heaven_box_twitter_number']);
						
						cache_put_data('heaven_box_tweets', $tweets);
					}
					*/
					
					/*
					echo '<pre>';
					print_r($tweets);
					echo '</pre>';
					*/
					
					/*
					if($tweets)
					{
						
						echo '
						<div class="heaven_box_twitter_header">
							<a href="https://twitter.com/', $tweets[0]->user->screen_name ,'" target="_blank">
								<img class="heaven_box_twitter_icon" src="', $settings['images_url'], '/2502/heaven_box_twitter_icon.png" alt="Twitter" />
								', $tweets[0]->user->screen_name ,'
							</a>
						</div>
						';
						
						
						foreach($tweets as $tweet_key => $tweet)
						{
							echo '
							<div class="heaven_box_tweet">', $tweet->text ,' <span class="heaven_box_tweet_timestamp">', date('F j, Y, g:i A', strtotime($tweet->created_at)) ,'</span></div>
							';
						}
						
					}
					else
					{
						echo 'Failed to Connect to Twitter';
					}
					*/
					
				}
				// Other wise use the setting for the text
				else
				{
					echo '
					', !empty($modSettings['heaven_box_text']) ? $modSettings['heaven_box_text'] : 'Nothing New...' ,'
					';
				}
				
				
				
	echo '
			</div>
		</div>

		<div class="heaven_border"></div>
	</div>

	<div class="top_bar">
		<div class="top_bar_inner" style="', !empty($settings['forum_width']) ? 'width: ' . $settings['forum_width'] : 'width: 1000px;' ,'">
			<div class="heaven_banner">
				<div class="heaven_banner_trinket">
					<img src="', $settings['images_url'], '/2502/heaven_banner_trinket.png" alt="Toggle" />
				</div>
				<div class="clear"></div>
				<div class="heaven_banner_fringe_left"></div>
				<div class="heaven_banner_fringe_right"></div>
				<div class="clear"></div>
			</div>
			
			<div class="top_bar_menu">
	';
				if(isset($context['menu_data_1']))
				{
					foreach($context['menu_data_1']['sections'] as $section_key => $section)
					{
						echo '
						<div class="top_bar_menu_item">
							', $section['title'] ,'
							
							<div class="top_bar_menu_sub_item_holder">
						';
					
							foreach($section['areas'] as $area_key => $area)
							{
								echo '
								<div class="top_bar_menu_sub_item"><a href="', $scripturl ,'?action=', $context['menu_data_1']['current_action'] ,';area=', $area_key ,'', $context['menu_data_1']['extra_parameters'] ,'">', $area['label'] ,'</a></div>
								';
							}
							
						echo '
							</div>
						</div>
						';
					}
				}
	
	echo '
			</div>
			
			<div class="top_bar_user_box">
				<div class="top_bar_user_box_inner">
					<div class="user_box_guts">
	';
						if($context['user']['is_guest'])
						{
							echo '
								', $txt['login_or_register_with_links'] ,'
							';
						}
						else
						{
							echo '
								<div class="user_box_control">
									<a href="'. $scripturl .'?action=profile">', $context['user']['name'] ,'</a>
									<div class="user_box_arrow_down">
										<div class="user_box_arrow_down_trinket"></div>
									</div>
								</div>
								<div class="clear"></div>
							';
							
							echo '
							<div class="user_box_dropdown">
								<div class="user_box_dropdown_item">
									<a href="', $scripturl ,'?action=profile;"><img src="', $settings['images_url'] ,'/2502/user_box_profile_icon.png" alt="', $txt['profile'] ,'" />', $txt['profile'] ,'</a>
								</div>
								<div class="user_box_dropdown_item">
									<a href="', $scripturl ,'?action=profile;area=forumprofile"><img src="', $settings['images_url'] ,'/2502/user_box_edit_profile_icon.png" alt="', $txt['edit_profile'] ,'" /> ', $txt['edit_profile'] ,'</a>
								</div>
								<div class="user_box_dropdown_item">
									<a href="', $scripturl ,'?action=pm"><img src="', $settings['images_url'] ,'/2502/user_box_messages_icon.png" alt="', $txt['messages'] ,'" /> ', $txt['messages'] ,'</a>
								</div>
								<div class="user_box_dropdown_item">
									<a href="', $scripturl ,'?action=logout;', $context['session_var'] ,'=', $context['session_id'] ,'"><img src="', $settings['images_url'] ,'/2502/user_box_logout_icon.png" alt="', $txt['logout'] ,'" /> ', $txt['logout'] ,'</a>
								</div>
							</div>
							';
						}
					
						
	echo '
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="middle">
		<div class="middle_inner" style="', !empty($settings['forum_width']) ? 'width: ' . $settings['forum_width'] : 'width: 1000px;' ,'">
			
			<div class="banner_crap">
				<div class="banner_image">
					<a class="banner_link" href="', $scripturl, '">
						', empty($context['header_logo_url_html_safe']) ? $context['forum_name'] : '<img src="' . $context['header_logo_url_html_safe'] . '" alt="' . $context['forum_name'] . '" />' ,'
					</a>
				</div>
				<div class="banner_text">
					<a class="banner_link" href="', $scripturl, '">
						<span class="banner_text_inner">
							<span class="banner_main_text">', $txt['team_2502'] ,'</span>
							<span class="banner_sub_text">', $txt['first_team_ephs_robotics'] ,'</span>
						</span>
					</a>
				</div>
			</div>
			
			<div class="search_holder">
				<div class="search_body">
				
				<form id="search_form" action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
					<div class="search_input_holder">
						<div class="search_input_inner">
							<div class="search_input_aligner">
								<input class="search_input" type="text" name="search" alt="Search" placeholder="Search..." />
							</div>
						</div>
					</div>
					
					<input class="search_button" type="submit" name="submit" alt="Search Submit" value="', $txt['search'], '" />
					<input type="hidden" name="advanced" value="0" />';

					// Search within current topic?
					if (!empty($context['current_topic']))
						echo '
									<input type="hidden" name="topic" value="', $context['current_topic'], '" />';
					// If we're on a certain board, limit it to this board ;).
					elseif (!empty($context['current_board']))
						echo '
									<input type="hidden" name="brd[', $context['current_board'], ']" value="', $context['current_board'], '" />';

	echo '
					</form>
					
					<a target="_blank" href="https://www.facebook.com/team2502"><img style="margin: 3px; border: 0 solid; float: right;" height="20" src="Images/facebook.png" /></a>
					<a target="_blank" href="http://team2502.tumblr.com/"><img style="margin: 3px; border: 0 solid; float: right;" height="20" src="Images/tumblr.png" /></a>
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="nav_bar">
		<div class="nav_bar_inner" style="', !empty($settings['forum_width']) ? 'width: ' . $settings['forum_width'] : 'width: 1000px;' ,'">
			', template_menu() ,'
		</div>
	</div>
	';
	

	echo '
	<div class="content_wrapper" style="', !empty($settings['forum_width']) ? 'width: ' . $settings['forum_width'] : 'width: 1000px;' ,'">
		<div class="content_inner">
	';
	
	// Show the navigation tree.
	if(SMF != 'SSI')
		theme_linktree();
	else
	{
		echo '
		<div class="linktree_spacer_substitute"></div>
		';
	}
}

function template_body_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
		</div>
	</div>
	';
	
	
	
	
	echo '
	<div class="footer">
		<div class="footer_inner" style="', !empty($settings['forum_width']) ? 'width: ' . $settings['forum_width'] : 'width: 1000px;' ,'">
		
			<div class="footer_array">

				<div class="footer_array_contact">
					<div class="footer_array_title">', $txt['footer_contact'] ,'</div>
					
					<div class="footer_array_content">
						<!--
						<form method="post" action="', $scripturl ,'?action=contactteam">

							<div class="footer_contact_form_input">
								<label for="footer_contact_name">', $txt['footer_contact_name'] ,':</label>
								<input id="footer_contact_name" type="text" name="name" placeholder="', $txt['footer_contact_name'] ,'" />
							</div>
							
							<div class="footer_contact_form_input">
								<label for="footer_contact_email">', $txt['footer_contact_email'] ,':</label>
								<input id="footer_contact_email" type="text" name="email" placeholder="', $txt['footer_contact_email'] ,'" />
							</div>
							
							<div class="footer_contact_form_input">
								<label for="footer_contact_subject">', $txt['footer_contact_subject'] ,':</label>
								<input id="footer_contact_subject" type="text" name="subject" placeholder="', $txt['footer_contact_subject'] ,'" />
							</div>
							
							<div class="footer_contact_form_input">
								<label for="footer_contact_message">', $txt['footer_contact_message'] ,':</label>
								<textarea id="footer_contact_message" name="message" rows="6" cols="20" placeholder="', $txt['footer_contact_message'] ,'"></textarea>
							</div>
								
								
							<div class="floatright">
								<input class="footer_contact_form_send" type="submit" value="', $txt['footer_contact_send'] ,'" />
							</div>
							
						</form>
						-->
						<div class="footer_contact_body">
							<script type="text/javascript">
								var email1 = ".com";
								var email2 = "goodson@";
								var email3 = "team2502";
								var email4 = "ian.";
								document.write("Lead Mentor: Ian Goodson,<br />");
								document.write("Email: "+email4+email2+email3+email1);
							</script>
						</div>
					</div>
					
				</div>
				
				<div class="footer_array_popular_topics">
					<div class="footer_array_title">', $txt['footer_popular_topics'] ,'</div>
					
					<div class="footer_array_content">
						<div class="footer_array_popular_topics_topic_holder">
	';
					
							$top_topics = topTopics('replies', 10, '');
							/*
							echo '<pre>';
							print_r($top_topics);
							echo '<pre>';
							*/
							foreach($top_topics as $top_topic_key => $top_topic)
							{
								echo '
								<div class="footer_array_popular_topics_topic">
									<a href="', $top_topic['href'] ,'">', $top_topic['subject'] ,'</a>
								</div>
								';
							}
	echo '
						</div>
					</div>
				</div>
				
				<div class="footer_array_about_us">
					<div class="footer_array_title">', $txt['footer_about_us'] ,'</div>
					
					<div class="footer_array_content">
						<div class="footer_array_about_us_content">
							', $modSettings['about_us_footer_text'] ,'
						</div>
					</div>
					
				</div>
				
				
			</div>
		
			<div class="footer_array">
				<div class="footer_frc">
					<a href="http://www.usfirst.org/" target="_blank"><img src="', $settings['images_url'], '/2502/first_logo_white_50.png" alt="FIRST" /></a>
				</div>
			
				<div class="footer_copyright">
					', theme_copyright() ,'
				
	';
					echo '
					<div>';

					if($context['allow_admin'])
						echo '<a href="', $scripturl ,'?action=admin">', $txt['admin'] ,'</a>';
						
					if($context['allow_admin'] && $context['allow_moderation_center'])
						echo ' | ';
					
					if($context['allow_moderation_center'])
						echo '<a href="', $scripturl ,'?action=moderate">', $txt['moderate'] ,'</a>';
						
					echo '
					</div>';
							
							

		
					// Show the load time?
					if ($context['show_load_time'])
						echo '
						<p>', $txt['page_created'], $context['load_time'], $txt['seconds_with'], $context['load_queries'], $txt['queries'], '</p>';
	echo '
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			
		</div>
	</div>
	';
}

function template_html_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree($force_show = false)
{
	global $context, $settings, $options, $shown_linktree;

	// If linktree is empty, just return - also allow an override.
	if (empty($context['linktree']) || (!empty($context['dont_default_linktree']) && !$force_show))
		return;

	echo '
	<div class="navigate_section">
		<ul>';

	// Each tree item has a URL and name. Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		echo '
			<li', ($link_num == count($context['linktree']) - 1) ? ' class="last"' : '', '>';

		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'];

		// Show the link, including a URL if it should have one.
		echo $settings['linktree_link'] && isset($tree['url']) ? '
				<a href="' . $tree['url'] . '"><span>' . $tree['name'] . '</span></a>' : '<span>' . $tree['name'] . '</span>';

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo $tree['extra_after'];

		// Don't show a separator for the last one.
		if ($link_num != count($context['linktree']) - 1)
			echo ' &#187;';

		echo '
			</li>';
	}
	echo '
		</ul>
	</div>';

	$shown_linktree = true;
}

// Show the menu up top. Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	/*
	echo '<pre>';
	print_r($context['menu_buttons']);
	echo '</pre>';
	*/
	
	echo '
	<div class="navbar">';

	foreach ($context['menu_buttons'] as $act => $button)
	{
		echo '
			<div class="nav_bar_item_wrapper">
				<a class="nav_bar_item ', $button['active_button'] ? 'active' : '' ,'" href="', $button['href'], '"', isset($button['target']) ? ' target="' . $button['target'] . '"' : '', '>
						', $button['title'], '
				</a>
		';
				if (!empty($button['sub_buttons']))
				{
					echo '
					<div class="nav_bar_sub_item_holder">
					';
						foreach ($button['sub_buttons'] as $childbutton)
						{
							echo '
							<a class="nav_bar_sub_item" href="', $childbutton['href'], '"', isset($childbutton['target']) ? ' target="' . $childbutton['target'] . '"' : '', '>
									', $childbutton['title'], '
							</a>
							';
						}
					
					echo '
					</div>
					';
				}
		echo '
		</div>
		';
	}

	echo '
	</div>';
}

// Generate a strip of buttons.
function template_button_strip($button_strip, $direction = 'top', $strip_options = array())
{
	global $settings, $context, $txt, $scripturl;

	if (!is_array($strip_options))
		$strip_options = array();

	// List the buttons in reverse order for RTL languages.
	if ($context['right_to_left'])
		$button_strip = array_reverse($button_strip, true);

	// Create the buttons...
	$buttons = array();
	foreach ($button_strip as $key => $value)
	{
		if (!isset($value['test']) || !empty($context[$value['test']]))
			$buttons[] = '
				<li>
					<a' . (isset($value['id']) ? ' id="button_strip_' . $value['id'] . '"' : '') . ' class="button_strip_' . $key . (isset($value['active']) ? ' active' : '') . '" href="' . $value['url'] . '"' . (isset($value['custom']) ? ' ' . $value['custom'] : '') . '>
						<span>' . $txt[$value['text']] . '</span>
					</a>
				</li>';
	}

	// No buttons? No button strip either.
	if (empty($buttons))
		return;

	// Make the last one, as easy as possible.
	$buttons[count($buttons) - 1] = str_replace('<span>', '<span class="last">', $buttons[count($buttons) - 1]);

	echo '
		<div class="buttonlist', !empty($direction) ? ' float' . $direction : '', '"', (empty($buttons) ? ' style="display: none;"' : ''), (!empty($strip_options['id']) ? ' id="' . $strip_options['id'] . '"': ''), '>
			<ul>',
				implode('', $buttons), '
			</ul>
		</div>';
}


// Shows the top topics.
function topTopics($type = 'replies', $num_topics = 10, $output_method = 'echo')
{
	global $db_prefix, $txt, $scripturl, $user_info, $modSettings, $smcFunc, $context;

	if ($modSettings['totalMessages'] > 100000)
	{
		// !!! Why don't we use {query(_wanna)_see_board}?
		$request = $smcFunc['db_query']('', '
			SELECT id_topic
			FROM {db_prefix}topics
			WHERE num_' . ($type != 'replies' ? 'views' : 'replies') . ' != 0' . ($modSettings['postmod_active'] ? '
				AND approved = {int:is_approved}' : '') . '
			ORDER BY num_' . ($type != 'replies' ? 'views' : 'replies') . ' DESC
			LIMIT {int:limit}',
			array(
				'is_approved' => 1,
				'limit' => $num_topics > 100 ? ($num_topics + ($num_topics / 2)) : 100,
			)
		);
		$topic_ids = array();
		while ($row = $smcFunc['db_fetch_assoc']($request))
			$topic_ids[] = $row['id_topic'];
		$smcFunc['db_free_result']($request);
	}
	else
		$topic_ids = array();

	$request = $smcFunc['db_query']('', '
		SELECT m.subject, m.id_topic, t.num_views, t.num_replies
		FROM {db_prefix}topics AS t
			INNER JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)
			INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
		WHERE {query_wanna_see_board}' . ($modSettings['postmod_active'] ? '
			AND t.approved = {int:is_approved}' : '') . (!empty($topic_ids) ? '
			AND t.id_topic IN ({array_int:topic_list})' : '') . (!empty($modSettings['recycle_enable']) && $modSettings['recycle_board'] > 0 ? '
			AND b.id_board != {int:recycle_enable}' : '') . '
		ORDER BY t.num_' . ($type != 'replies' ? 'views' : 'replies') . ' DESC
		LIMIT {int:limit}',
		array(
			'topic_list' => $topic_ids,
			'is_approved' => 1,
			'recycle_enable' => $modSettings['recycle_board'],
			'limit' => $num_topics,
		)
	);
	$topics = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		censorText($row['subject']);

		$topics[] = array(
			'id' => $row['id_topic'],
			'subject' => $row['subject'],
			'num_replies' => $row['num_replies'],
			'num_views' => $row['num_views'],
			'href' => $scripturl . '?topic=' . $row['id_topic'] . '.0',
			'link' => '<a href="' . $scripturl . '?topic=' . $row['id_topic'] . '.0">' . $row['subject'] . '</a>',
		);
	}
	$smcFunc['db_free_result']($request);

	if ($output_method != 'echo' || empty($topics))
		return $topics;

	echo '
		<table class="ssi_table">
			<tr>
				<th align="left"></th>
				<th align="left">', $txt['views'], '</th>
				<th align="left">', $txt['replies'], '</th>
			</tr>';
	foreach ($topics as $topic)
		echo '
			<tr>
				<td align="left">
					', $topic['link'], '
				</td>
				<td align="right">', comma_format($topic['num_views']), '</td>
				<td align="right">', comma_format($topic['num_replies']), '</td>
			</tr>';
	echo '
		</table>';
}



function twitter_call($username, $number = 3)
{
	//$raw_pull = file_get_contents('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name='. $username .'&count='. $number .'');
	
	$ch = curl_init('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name='. $username .'&count='. $number .'');
	curl_setopt($ch,CURLOPT_TIMEOUT, 30);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$raw_pull = curl_exec($ch);
	
	// If the twitter pull failed, return false
	if(!$raw_pull)
		return false;
		
		
	// make it into a class array kinda thing
	$raw_json_decode = json_decode($raw_pull);
	
	// now replace urls so they are linked and stuff...\
	foreach($raw_json_decode as $tweet_key => $tweet)
	{
		// If there are urls to replace...
		if(!empty($tweet->entities->urls))
		{
			$raw_json_decode[$tweet_key]->text = substr_replace($tweet->text, '<a href="'. $tweet->entities->urls[0]->expanded_url .'" target="_blank"> '. $tweet->entities->urls[0]->display_url . '</a>', $tweet->entities->urls[0]->indices[0], $tweet->entities->urls[0]->indices[1] - $tweet->entities->urls[0]->indices[0]);
		}
	}
	
	return $raw_json_decode;
}











?>
