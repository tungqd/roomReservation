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
$closedRooms;
require("./models/model.php");
/**
*
* adminController
*/
function adminController()
{
	global $userData, $rooms, $schedules, $tentativeBooking;
	global $closedRooms;
	$rooms = displayRooms();
	$closedRooms = getRoomStatus();
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
	else if (isset($_GET["ac"]) && $_GET["ac"] == "manageUsers") {
    	$_SESSION['view'] = 'manageUsers';
    	$userData =displayUsers();
	}
	else if (isset($_POST["ac"]) && $_POST["ac"] == "addAUser") {
	    if (addUser($_POST['id'], $_POST['name'], $_POST['position'])) {
    	    $_SESSION['view'] = 'manageUsers';
            $userData =displayUsers();
	    }
    	else {
        	echo "<script language=javascript>alert('Key constraint violation!');</script>";
        	$userData =displayUsers();
        	$_SESSION['view'] = 'manageUsers';
    	}
	}
	else if (isset($_POST["ac"]) && $_POST["ac"] == "deleteUser") {
    	if (deleteUser($_POST['id'])) {
        	$_SESSION['view'] = 'manageUsers';
            $userData =displayUsers();
    	}
    	else {
        	echo "<script language=javascript>alert('Unable to delete this user!');</script>";
        	$userData =displayUsers();
        	$_SESSION['view'] = 'manageUsers';
    	}
	}
	else if (isset($_POST["ac"]) && $_POST["ac"] == "closeRoom") {
    	if (!closeRoom($_POST["rID"])) {
    	    echo "<script language=javascript>alert('Unable to close this room!');</script>";
    	}
        $closedRooms = getRoomStatus();
    	$rooms = displayRooms();
    	$_SESSION['view'] = 'backend';
	}
	else if (isset($_POST["ac"]) && $_POST["ac"] == "openRoom") {
    	if (!openRoom($_POST["rID"])) {
    	    echo "<script language=javascript>alert('Unable to close this room!');</script>";
    	}
        $closedRooms = getRoomStatus();
    	$rooms = displayRooms();
    	$_SESSION['view'] = 'backend';
	}
	else if (isset($_GET["ac"]) && $_GET["ac"] == "pullStats") {
	    $userData = pullStats($_GET['days']);
    	$_SESSION['view'] = 'statistics';
    }
    else if (isset($_GET["ac"]) && $_GET["ac"] == "archive") {
	    if (archive($_GET['date'])) {
    	    echo "<script language=javascript>alert('Backup successful!');window.location = 'index.php?c=admin';</script>";
	    }
	    else {
    	    echo "<script language=javascript>alert('Backup failed!');window.location = 'index.php?c=admin';</script>";
	    }
    	$_SESSION['view'] = 'backend';
    }
    else if (isset($_POST["ac"]) &&  $_POST["ac"] == "adminDeleteBooking") {
	    if (deleteBooking($_POST['bID'])) {
	        
    	    echo "<script language=javascript>alert('Booking has been deleted.');
    	    window.location = 'index.php?c=admin&view=adminLookup&ac=lookupUserMeetings'</script>";
	    }
	    else {
    	    echo "<script language=javascript>alert('Booking cannot be deleted.');
    	    window.location = 'index.php?c=admin&view=adminLookup&ac=lookupUserMeetings'</script>";
	    }
	    $userData =lookupUserMeetings();
	    $_SESSION["view"] = "adminLookup";
    }
	else{
	    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    	    $_SESSION['view'] = 'backend';    
	    }
		else {
    		$_SESSION['view'] = 'frontpage';
    		$rooms = availRooms();
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