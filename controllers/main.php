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

$data;
$rooms;
$schedules;
require("./models/model.php");
function mainController()
{
	global $data, $rooms, $schedules;
	if ($_POST["ac"] == "lookupMeetings") {
		$data = lookupMeetings($_POST["uID"]);
		$_SESSION['view'] = 'userLookup';	

	}
	else if($_POST["ac"] == "bookMeeting"){
		$_SESSION['view'] = 'bookMeeting';	
	}
	else if ($_POST["ac"] == "lookupARoom") {
		$schedules = lookupRoom($_POST["room"]);
		$_SESSION['view'] = 'lookupRoom';
	}
	else{
		$_SESSION['view'] = 'frontpage';
		$rooms = availRooms();
	}
}

function lookupMeetings($uID) {
	return getUserMeetings($uID);
}

function lookupRoom($rID) {
	return roomSchedule($rID);
}
?>