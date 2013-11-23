<?php
/**
* main.php
*
* main controller
*
* @author   Kingkong
*
*
*/

$data;
$rooms;
$schedules;
require("./models/model.php");
/**
*
* Main Controller
*/
function mainController()
{
	global $data, $rooms, $schedules;
	global $closedRooms;
	$closedRooms = getRoomStatus();
	if (isset($_POST["ac"]) &&  $_POST["ac"] == "lookupMeetings") {
		$data = lookupMeetings($_POST["uID"]);
		$_SESSION['view'] = 'userLookup';	

	}
	else if(isset($_POST["ac"]) &&  $_POST["ac"] == "bookMeeting"){
		$_SESSION['view'] = 'bookMeeting';	
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "lookupARoom") {
		$schedules = lookupRoom($_POST["room"]);
		$_SESSION['view'] = 'lookupRoom';
	}
	else{
		$_SESSION['view'] = 'frontpage';
		$_SESSION["overload"] = false;
		$rooms = availRooms();
	}
}

/**
*
* User lookup own meetings
*/ 
function lookupMeetings($uID) {
	return getUserMeetings($uID);
}

/**
*
* User lookups room schedule
*/
function lookupRoom($rID) {
	return roomSchedule($rID);
}
?>