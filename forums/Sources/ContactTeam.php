<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines http://www.simplemachines.org
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/*	The functions in this file deal with sending topics to a friend or
	moderator, and those functions are:

	void ContactTeam()
		- Uses Theme settings emails
		- is accessed via ?action=contactteam
*/


// Send a topic to a friend.
function ContactTeam()
{
	global $txt, $context, $scripturl, $sourcedir, $smcFunc, $modSettings;

	if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message'])) 
	{
		$subject = "";
		$to = 'captains@team2502.com'; // Defaults to Jesse Loi
		// $email_to = $_POST['email_to'];
		
		/*
		if ($email_to == "test") {
			$to = "madlittlemods@gmail.com";
		}
		elseif($email_to == "captains") {
			$to = "captains@team2502.com";
		} else if ($email_to = "alex") {
			$to = "alex.reinking@team2502.com";
		} else if ($email_to = "blake") {
			$to = "blake.trantina@team2502.com";
		} else if ($email_to = "jesse") {
			$to = "jesse.loi@team2502.com";
		} else if ($email_to = "joe") {
			$to = "joe.haynes@team2502.com";
		} else if ($email_to = "justine") {
			$to = "justine.myers@team2502.com";
		} else if ($email_to = "kat") {
			$to = "kat.hammer@team2502.com";
		} else if ($email_to = "casey") {
			$to = "casey.carlson@team2502.com";
		}
		*/
		
		
		if (isset($_POST['subject'])) $subject = $_POST['subject'];
		$email = spamcheck($_POST['email']);
		if ($email == TRUE) $email = $_POST['email'];
		if ($email !== FALSE) {
			mail($to, $subject, $_POST['message'], "From: ".$email."\r\n");
			//error_log($to);
		}
	}
	
	// Back to the topic!
	redirectexit();
}

function spamcheck($field)
{
	// filter_var() sanitizes the e-mail
	// address using FILTER_SANITIZE_EMAIL
	$field = filter_var($field, FILTER_SANITIZE_EMAIL);

	// filter_var() validates the e-mail
	// address using FILTER_VALIDATE_EMAIL
	if(filter_var($field, FILTER_VALIDATE_EMAIL))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

?>