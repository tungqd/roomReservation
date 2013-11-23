<?php
/**
* model.php
* 
* @author   Kingkong
*
*
*/

require_once('./models/connection.php');

/**
*
* This function gets current user meetings
* @param $uID: user ID
*/
function getUserMeetings($uID) 
{
	$query = "SELECT title, starttime, endtime, date, Room.name, attendees, Booking.status, Booking.ID, Booking.uID
	FROM Booking, Room WHERE Booking.rID = Room.ID AND 
	Booking.ID in (SELECT distinct bookingID FROM UserMeeting WHERE uID = $uID);";
	
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
*
*/
function addAMeeting($title, $starttime, $endtime, $date, $rID, $uID, $attendees, $status, $updatedAt) {
	$query ="INSERT INTO Booking(title, starttime, endtime, date, rID, uID, attendees, status, updatedAt) 
		VALUES ('$title', '$starttime', '$endtime', '$date', '$rID', '$uID', '$attendees', '$status', '$updatedAt');";
	if (mysql_query($query)) {
            echo "<script language=javascript>alert('Your booking has been processed successfully.'); window.location = 'index.php'; </script>";
    } else {
        echo "<script language=javascript>alert('Constraint violation.Please try again.'); window.location = 'index.php?c=booking&ac=bookMeeting&view=bookMeeting'; </script>";
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
	GROUP BY rID) AND Room.status = 'open';";
	
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
	$array = array();
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
    	 echo "<script language=javascript>alert('Your booking has been processed successfully.');window.location = 'index.php';</script>";
    } else {
        echo "<script language=javascript>alert('Please try again.'); window.location = 'index.php'; </script>";
	}
}
/**
*
* This function cancels a booking
*/
function deleteBooking($id) {
    $query="DELETE FROM Booking WHERE ID = $id;";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* This function retrieve all user meetings for administrator
* @return array containing all meetings information
*/
function getAllMeetings() {
    $query = "SELECT title, starttime, endtime, date, Room.name, attendees, Booking.status, Booking.ID, Booking.uID
	FROM Booking, Room WHERE Booking.rID = Room.ID AND 
	Booking.ID in (SELECT distinct bookingID FROM UserMeeting)
	ORDER BY Booking.ID;";
	
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
* Modify a booking for administrator
*/
function adminModifyBooking($bID, $title, $rID, $starttime, $endtime, $date, $attendees, $status) {
    $query="UPDATE RoomReservation.Booking SET title = '$title', starttime = '$starttime', endtime = '$endtime', date = '$date', 
            rID = '$rID', attendees = '$attendees', status = '$status', updatedAt = CURDATE() WHERE ID = '$bID';";
    if (mysql_query($query)) {
    	 echo "<script language=javascript>alert('Booking has been modified successfully.');window.location = 'index.php?c=admin';</script>";
    } else {
        echo "<script language=javascript>alert('Please try again.'); window.location = 'index.php?c=admin'; </script>";
	}
}
/**
*
* Get tentative bookings
* @return array containing all tentative bookings
*/
function getTentativeBooking() {
    $query ="SELECT ID, title, starttime, endtime, date, rID, uID, attendees, status
            FROM RoomReservation.Booking WHERE status = 'tentative';";
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
* Set booking status to confirmed
*/
function approveBooking($bID) {
    $query ="UPDATE Booking SET status ='confirmed' WHERE status='tentative' AND ID=$bID;";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* Display user information
*/
function displayUsers() {
    $query="SELECT ID,name,position FROM User ORDER BY ID;";
    $result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
* Add new user
*/
function addUser($id, $name, $position) {
    $query="INSERT INTO User(ID, name, position) VALUES ('$id','$name', '$position');";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* Delete user
*/
function deleteUser($id) {
    $query="DELETE FROM User WHERE ID = $id;";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* Lookup conference room information for administrator
*/
function displayRooms() {
    $query="SELECT ID,name,location,capacity,status FROM Room ORDER BY ID;";
    $result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
* Close a conference room
*/
function closeRoom($rID) {
    $query="UPDATE Room SET status='closed' WHERE status='open' and ID =$rID;";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* Open a conference room
*/
function openRoom($rID) {
    $query="UPDATE Room SET status='open' WHERE status='closed' and ID =$rID;";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* Get room status
*/
function getRoomStatus() {
    $query="SELECT status FROM RoomReservation.Room;";
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
* Pull statistics of bookings for the last x days
*/
function pullStats($days) {
    $query="SELECT title, Room.name AS Room, starttime, endtime, date, User.name AS organizer,attendees, Booking.status
     FROM Booking JOIN User ON (Booking.uID = User.ID) JOIN Room 
     WHERE Booking.rID = Room.ID AND date >= date_sub(curdate(), interval $days day) AND date<=curdate();";
    $result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
* Archive the bookings before certain date
*/
function archive($date) {
    mysql_query("TRUNCATE TABLE Archive;");
    $query="CALL Backup('$date');";
    if (mysql_query($query)) {
    	return true;
	}
	else {
    	return false;
	}
}
/**
*
* is number of attendees bigger than room capacity
*/
function checkCapacity($rID, $attendees) {
    $query="SELECT count(*) AS Overload FROM Room WHERE capacity < $attendees AND ID = $rID;";
    $result = mysql_query($query);
    $overload = mysql_result($result,0);
    return $overload["Overload"];
}
/**
*
* Retrieve room with bigger capacity
*/
function displayRoomCapacity() {
    $query="SELECT name, capacity FROM Room ORDER BY ID;";
    $result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$array = array();
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
?>