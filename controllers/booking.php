<?php
/**
* booking.php
*
* booking controller
*
* @author   Tung Dang
*
*
*/


require("./models/model.php");
function bookingController()
{
	global $rooms;	
	if($_POST["ac"] == "bookMeeting"){
		$_SESSION['view'] = 'bookMeeting';	
	}
	else if ($_POST["ac"] == "bookAMeeting") {
		$updatedAt = date("Y-m-d");
		$starttime = $_POST["starttime"]."00";
		$endtime = $_POST["endtime"]."00";
		bookAMeeting($_POST["title"],$starttime,$endtime,$_POST["date"],$_POST["room"],$_POST["uID"],$_POST["attendees"], $updatedAt);
		$rooms = availRooms();
		$_SESSION['view'] = 'frontpage';
	}
	else{
		$_SESSION['view'] = 'frontpage';
	}
}

function bookAMeeting($title, $starttime, $endtime, $date, $rID, $uID, $attendees, $updatedAt) {
	if ($uID <=200) {
		$status = "confirmed";
	}
	else {
		$status = "tentative";
	}
	addAMeeting($title, $starttime, $endtime, $date, $rID, $uID, $attendees, $status, $updatedAt);
}
?>