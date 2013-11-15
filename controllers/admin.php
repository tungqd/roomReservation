<?php
/**
* main.php
*
* main controller
*
* @author   Tung Dang
*
*
*/

$userData;
$rooms;
$schedules;
require("./models/model.php");
/**
*
* adminController
*/
function adminController()
{
	global $userData, $rooms, $schedules;
	if (isset($_GET["ac"]) &&  $_GET["ac"] == "lookupUserMeetings") {
	    $userData =lookupUserMeetings();
		$_SESSION['view'] = 'adminLookup';	

	}
	else{
	    if ($_SESSION['loggedIn']) {
    	    $_SESSION['view'] = 'backend';    
	    }
		else {
    		$_SESSION['view'] = 'frontpage';
		}
	}
}
/**
*
* Lookup all user meetings
*/
function lookupUserMeetings() {
	return getAllMeetings();
}

?>