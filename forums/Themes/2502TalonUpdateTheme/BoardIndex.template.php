<?php
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

function template_main()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	// Show some statistics if stat info is off.
	if (!$settings['show_stats_index'])
		echo '
	<div id="index_common_stats">
		', $txt['members'], ': ', $context['common_stats']['total_members'], ' &nbsp;&#8226;&nbsp; ', $txt['posts_made'], ': ', $context['common_stats']['total_posts'], ' &nbsp;&#8226;&nbsp; ', $txt['topics'], ': ', $context['common_stats']['total_topics'], '
		', ($settings['show_latest_member'] ? ' ' . $txt['welcome_member'] . ' <strong>' . $context['common_stats']['latest_member']['link'] . '</strong>' . $txt['newest_member'] : '') , '
	</div>';

	// Show the news fader?  (assuming there are things to show...)
	if ($settings['show_newsfader'] && !empty($context['fader_news_lines']))
	{
		echo '
	<div id="newsfader">
		<div class="cat_bar">
			<h3 class="catbg">
				<img id="newsupshrink" src="', $settings['images_url'], '/collapse.gif" alt="*" title="', $txt['upshrink_description'], '" align="bottom" style="display: none;" />
				', $txt['news'], '
			</h3>
		</div>
		<ul class="reset" id="smfFadeScroller"', empty($options['collapse_news_fader']) ? '' : ' style="display: none;"', '>';

			foreach ($context['news_lines'] as $news)
				echo '
			<li>', $news, '</li>';

	echo '
		</ul>
	</div>
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/fader.js"></script>
	<script type="text/javascript"><!-- // --><![CDATA[

		// Create a news fader object.
		var oNewsFader = new smf_NewsFader({
			sSelf: \'oNewsFader\',
			sFaderControlId: \'smfFadeScroller\',
			sItemTemplate: ', JavaScriptEscape('<strong>%1$s</strong>'), ',
			iFadeDelay: ', empty($settings['newsfader_time']) ? 5000 : $settings['newsfader_time'], '
		});

		// Create the news fader toggle.
		var smfNewsFadeToggle = new smc_Toggle({
			bToggleEnabled: true,
			bCurrentlyCollapsed: ', empty($options['collapse_news_fader']) ? 'false' : 'true', ',
			aSwappableContainers: [
				\'smfFadeScroller\'
			],
			aSwapImages: [
				{
					sId: \'newsupshrink\',
					srcExpanded: smf_images_url + \'/collapse.gif\',
					altExpanded: ', JavaScriptEscape($txt['upshrink_description']), ',
					srcCollapsed: smf_images_url + \'/expand.gif\',
					altCollapsed: ', JavaScriptEscape($txt['upshrink_description']), '
				}
			],
			oThemeOptions: {
				bUseThemeSettings: ', $context['user']['is_guest'] ? 'false' : 'true', ',
				sOptionName: \'collapse_news_fader\',
				sSessionVar: ', JavaScriptEscape($context['session_var']), ',
				sSessionId: ', JavaScriptEscape($context['session_id']), '
			},
			oCookieOptions: {
				bUseCookie: ', $context['user']['is_guest'] ? 'true' : 'false', ',
				sCookieName: \'newsupshrink\'
			}
		});
	// ]]></script>';
	}

	echo '
	<div id="boardindex_table">
	';

	/* Each category in categories is made up of:
	id, href, link, name, is_collapsed (is it collapsed?), can_collapse (is it okay if it is?),
	new (is it new?), collapse_href (href to collapse/expand), collapse_image (up/down image),
	and boards. (see below.) */
	$c = 1;
	foreach ($context['categories'] as $category)
	{
		// If theres no parent boards we can see, avoid showing an empty category (unless its collapsed)
		if (empty($category['boards']) && !$category['is_collapsed'])
			continue;

		echo '

			<div class="cat_bar" id="category_', $category['id'] ,'_boards">
				<div class="catbg">
				
					<div class="cat_bar_title">', $category['link'], '</div>';

					// If this category even can collapse, show a link to collapse it.
					if ($category['can_collapse'])
						echo '
						<div class="cat_bar_trinket">
							<a class="collapse" href="', $category['collapse_href'], '">', $category['collapse_image'], '</a>
						</div>';


		echo '
				</div>
			</div>
		';

		// Assuming the category hasn't been collapsed...
		if (!$category['is_collapsed'])
		{
			echo '
			<div class="board_holder">';

			/* Each board in each category's boards has:
			new (is it new?), id, name, description, moderators (see below), link_moderators (just a list.),
			children (see below.), link_children (easier to use.), children_new (are they new?),
			topics (# of), posts (# of), link, href, and last_post. (see below.) */
			foreach ($category['boards'] as $board)
			{
				echo '
				<div class="board_seperator"></div>
				<table class="board" id="board_', $board['id'] ,'">
					<tbody >
						<tr>
							<td class="board_icon" ', !empty($board['children']) ? ' rowspan="2"' : '', '>
								<a href="', ($board['is_redirect'] || $context['user']['is_guest'] ? $board['href'] : $scripturl . '?action=unread;board=' . $board['id'] . '.0;children'), '">';

						// If the board or children is new, show an indicator.
						if ($board['new'] || $board['children_new'])
							echo '
									<img src="', $settings['images_url'], '/2502/board_icon.png" alt="', $txt['new_posts'], '" title="', $txt['new_posts'], '" />';
						// Is it a redirection board?
						elseif ($board['is_redirect'])
							echo '
									<img src="', $settings['images_url'], '/2502/board_redirect_icon.png" style="opacity: .5;" alt="*" title="*" />';
						// No new posts at all! The agony!!
						else
							echo '
									<img src="', $settings['images_url'], '/2502/board_icon.png" style="opacity: .5;" alt="', $txt['old_posts'], '" title="', $txt['old_posts'], '" />';

						echo '
								</a>
							</td>
							<td class="board_info">
								<div class="board_subject"><a href="', $board['href'], '" name="b', $board['id'], '">', $board['name'], '</a></div>

								<div class="board_description">', $board['description'] , '</div>';

						
						// Show some basic information about the number of posts, etc.
							echo '
							</td>
							
							<td class="board_stats" ', !empty($board['children']) ? ' rowspan="2"' : '', '>
								<div>', comma_format($board['posts']), ' ', $board['is_redirect'] ? $txt['redirects'] : $txt['posts'], '</div>
								<div>', $board['is_redirect'] ? '' : comma_format($board['topics']) . ' ' . $txt['board_topics'], '</div>
							</td>
							
							<td class="board_lastpost" ', !empty($board['children']) ? ' rowspan="2"' : '', '>';

						/* The board's and children's 'last_post's have:
						time, timestamp (a number that represents the time.), id (of the post), topic (topic id.),
						link, href, subject, start (where they should go for the first unread post.),
						and member. (which has id, name, link, href, username in it.) */
						if (!empty($board['last_post']['id']))
							echo '
								<div>', $txt['last_post'], '  ', $txt['by'], ' ', $board['last_post']['member']['link'] , '</div>
								<div class="board_lastpost_time">', $txt['on'], ' ', date('F j, Y, g:i A', $board['last_post']['timestamp']) ,'</div>
								';
						echo '
							</td>
							
						</tr>';
						// Show the "Child Boards: ". (there's a link_children but we're going to bold the new ones...)
						if (!empty($board['children']))
						{
							// Sort the links into an array with new boards bold so it can be imploded.
							$children = array();
							/* Each child in each board's children has:
									id, name, description, new (is it new?), topics (#), posts (#), href, link, and last_post. */
							foreach ($board['children'] as $child)
							{
								if (!$child['is_redirect'])
									$child['link'] = '<a href="' . $child['href'] . '" ' . ($child['new'] ? 'class="new_posts" ' : '') . 'title="' . ($child['new'] ? $txt['new_posts'] : $txt['old_posts']) . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')">' . $child['name'] . ($child['new'] ? '</a> <a href="' . $scripturl . '?action=unread;board=' . $child['id'] . '" title="' . $txt['new_posts'] . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')"><img src="' . $settings['lang_images_url'] . '/new.gif" class="new_posts" alt="" />' : '') . '</a>';
								else
									$child['link'] = '<a href="' . $child['href'] . '" title="' . comma_format($child['posts']) . ' ' . $txt['redirects'] . '">' . $child['name'] . '</a>';

								// Has it posts awaiting approval?
								if ($child['can_approve_posts'] && ($child['unapproved_posts'] || $child['unapproved_topics']))
									$child['link'] .= ' <a href="' . $scripturl . '?action=moderate;area=postmod;sa=' . ($child['unapproved_topics'] > 0 ? 'topics' : 'posts') . ';brd=' . $child['id'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . sprintf($txt['unapproved_posts'], $child['unapproved_topics'], $child['unapproved_posts']) . '" class="moderation_link">(!)</a>';

								$children[] = $child['new'] ? '<strong>' . $child['link'] . '</strong>' : $child['link'];
							}
							echo '
							<tr class="board_children" id="board_', $board['id'], '_children">
								<td class="board_children_block">
									', $txt['parent_boards'], ': ', implode(', ', $children), '
								</td>
							</tr>';
						}
						
				echo '
					</tbody>
				</table>';
			}
	
			echo '
			</div>
			';
		}
		if(count($context['categories']) != $c)
		{
			echo '
			<div class="category_seperator"></div>
			';
		}
		
		$c++;
	}
	echo '
	</div>';

	if ($context['user']['is_logged'])
	{
		
		// Mark read button.
		$mark_read_button = array(
			'markread' => array('text' => 'mark_as_read', 'image' => 'markread.gif', 'lang' => true, 'url' => $scripturl . '?action=markasread;sa=all;' . $context['session_var'] . '=' . $context['session_id']),
		);


		// Show the mark all as read button?
		if ($settings['show_mark_read'] && !empty($context['categories']))
			echo '
			<div class="board_index_markread">
				<a href="', $scripturl ,'?action=markasread;sa=all;', $context['session_var'] ,'=', $context['session_id'] ,'">', $txt['mark_as_read'] ,'</a>
			</div>';
			
		echo '
		<div class="clear"></div>
		';
	}

	
	template_info_center();
}

function template_info_center()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	
	echo '
	<div class="info_center">';
	
		echo '
		<div class="users_online_title">
			', $txt['users_online'] ,'
		</div>
		';
		
		echo '
		<div class="users_online_block">';
		
			echo '
			', $context['show_who'] ? '<a href="' . $scripturl . '?action=who">' : '', comma_format($context['num_guests']), ' ', $context['num_guests'] == 1 ? $txt['guest'] : $txt['guests'], ', ' . comma_format($context['num_users_online']), ' ', $context['num_users_online'] == 1 ? $txt['user'] : $txt['users'];

			// Handle hidden users and buddies.
			$bracketList = array();
			if ($context['show_buddies'])
				$bracketList[] = comma_format($context['num_buddies']) . ' ' . ($context['num_buddies'] == 1 ? $txt['buddy'] : $txt['buddies']);
			if (!empty($context['num_spiders']))
				$bracketList[] = comma_format($context['num_spiders']) . ' ' . ($context['num_spiders'] == 1 ? $txt['spider'] : $txt['spiders']);
			if (!empty($context['num_users_hidden']))
				$bracketList[] = comma_format($context['num_users_hidden']) . ' ' . $txt['hidden'];

			if (!empty($bracketList))
				echo ' (' . implode(', ', $bracketList) . ')';

			echo $context['show_who'] ? '</a>' : '', '
			';
		
			// Assuming there ARE users online... each user in users_online has an id, username, name, group, href, and link.
			if (!empty($context['users_online']))
			{
				echo '
				<div>', implode(', ', $context['list_users_online']) ,'</div>
				';

				// Showing membergroups?
				if (!empty($settings['show_group_key']) && !empty($context['membergroups']))
					echo '
						<br />[' . implode(']&nbsp;&nbsp;[', $context['membergroups']) . ']';
			}
			

		
		echo '
		</div>';
		
		echo '
		
		<div class="smalltext">
			', $context['common_stats']['total_posts'], ' ', $txt['posts_made'], ', ', $context['common_stats']['total_topics'], ' ', $txt['topics'], ', ', $context['common_stats']['total_members'], ' ', $txt['members'], ' <br />
			', !empty($settings['show_latest_member']) ? $txt['latest_member'] . ': <strong> ' . $context['common_stats']['latest_member']['link'] . '</strong>' : '', '<br />
			', $context['show_stats'] ? '<a href="' . $scripturl . '?action=stats">' . $txt['more_stats'] . '</a>' : '', '
		</div>';
		
	echo '
	</div>';

	
}
?>