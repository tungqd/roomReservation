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
$tentativeBooking;
require("./models/model.php");
/**
*
* adminController
*/
function adminController()
{
	global $userData, $rooms, $schedules, $tentativeBooking;
	if (isset($_GET["ac"]) &&  $_GET["ac"] == "lookupUserMeetings") {
	    $userData =lookupUserMeetings();
		$_SESSION['view'] = 'adminLookup';	

	}	
	else if (isset($_GET["ac"]) && $_GET["ac"] == "approveBooking") {
	    $tentativeBooking=getTentative();
    	$_SESSION['view'] = 'approveBooking';
	}
	else if (isset($_POST["ac"]) && $_POST["ac"] == "approveABooking") {
	    if(approveBooking($_POST["id"])) {
	        echo "<script language=javascript>alert('Booking has been approved.');</script>";
	    }
	    else {
    	    echo "<script language=javascript>alert('Something went wrong!');</script>";
	    }
	    $tentativeBooking=getTentative();
        $_SESSION['view'] = 'approveBooking';	
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
/**
*
* Retrieve tentative bookings
*/
function getTentative() {
    return getTentativeBooking();
}
?>