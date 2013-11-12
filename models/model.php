<?php
/**
* model.php
* 
* @author   Tung Dang
*
*
*/

//require_once('./models/connection.php');

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "RoomReservation";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

/**
*
* This function gets current user meetings
*/
function getUserMeetings($uID) 
{
	$query = "SELECT title, starttime, endtime, date, Room.name, attendees, Booking.status, Booking.ID, Booking.uID
	FROM Booking, Room WHERE Booking.rID = Room.ID AND 
	Booking.ID in (SELECT distinct bookingID FROM UserMeeting WHERE uID = $uID);";
	
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	for ($i=0; $i <$num_rows; $i++)
	{
	$rows = mysql_fetch_array($result, MYSQL_ASSOC);
	$subarray = array();
	foreach ($rows as $name => $value) {
		$subarray[] = $value;
	}
	$array[] = $subarray;
	}
	
	return $array;	
}

/**
*
* This function adds meeting info into Booking relation
*/
function addAMeeting($title, $starttime, $endtime, $date, $rID, $uID, $attendees, $status, $updatedAt) {
	$query ="INSERT INTO Booking(title, starttime, endtime, date, rID, uID, attendees, status, updatedAt) 
		VALUES ('$title', '$starttime', '$endtime', '$date', '$rID', '$uID', '$attendees', '$status', '$updatedAt');";
	if (mysql_query($query)) {
            echo "<script language=javascript>alert('Your booking has been processed successfully.'); window.location = 'index.php'; </script>";
    } else {
        echo "<script language=javascript>alert('Room is busy. Please try again.'); window.location = 'index.php?c=booking&ac=bookMeeting&view=bookMeeting'; </script>";
	}
}	

/**
*
* This function retrieves available rooms at current time
*/
function availRooms() {
	$query = "SELECT name FROM Room WHERE ID NOT IN
	(SELECT rID FROM RoomReservation.Booking WHERE ID in
	(SELECT bookingID FROM Room, Schedule WHERE Room.ID = Schedule.rID)
	AND CURTIME() >= starttime AND CURTIME() <= endtime AND date = CURDATE()
	GROUP BY rID);";
	
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
	for ($i=0; $i <$num_rows; $i++)
	{
	$rows = mysql_fetch_array($result, MYSQL_NUM);	
	foreach ($rows as $room) {
		$array[] = $room;
	}
	}
	return $array;
}
/**
*
* This function returns a room schedule
*/
function roomSchedule($rID) {
	$query = "SELECT title, starttime, endtime, date, User.name, attendees
	FROM Schedule, Room, Booking, User WHERE Schedule.bookingID = Booking.ID and Schedule.rID = Room.ID 
	and User.ID = Booking.uID AND Schedule.rID =$rID;";
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	for ($i=0; $i <$num_rows; $i++)
	{
	$rows = mysql_fetch_array($result, MYSQL_ASSOC);
	$subarray = array();
	foreach ($rows as $name => $value) {
		$subarray[] = $value;
	}
	$array[] = $subarray;
	}
	
	return $array;
}
/**
*
* This function checks if there is an overlapped confirmed meeting
* Return 0 if there is no overlapped meeting
*/
function checkOverlap($startt,$endt,$mdate,$rID) {
    $query ="SELECT count(*) AS Overlap FROM Schedule JOIN Booking ON (Schedule.bookingID = Booking.ID) WHERE
	date = $mdate and Booking.rID = Schedule.rID and Schedule.rID = $rID
	and (($startt between starttime and endtime) or ($endt between starttime and endtime)
	or ($startt < starttime and $endt > endtime));";
    $result = mysql_query($query);
    $overlap = mysql_result($result,0);
    return $overlap["Overlap"];


}
/**
*
* Modify a booking
*/
function modifyBooking($bID, $title, $rID, $starttime, $endtime, $date, $attendees) {
    $query="UPDATE RoomReservation.Booking SET title = '$title', starttime = '$starttime', endtime = '$endtime', date = '$date', 
            rID = '$rID', attendees = '$attendees', updatedAt = CURDATE() WHERE ID = '$bID';";
    if (mysql_query($query)) {
    	 echo "<script language=javascript>alert('Your booking has been processed successfully.'); window.location = 'index.php'; </script>";
    } else {
        echo "<script language=javascript>alert('Please try again.'); window.location = 'index.php'; </script>";
	}
}
/**
*
* This function cancels a booking
*/
function cancelBooking($uID, $bID) {
    $query ="DELETE FROM Booking WHERE ID IN
	(SELECT bookingID FROM UserMeeting WHERE uID=$uID AND ID=$bID);";
	if (mysql_query($query)) {
    	return 1;
	}
	else {
    	return 0;
	}
}
?>