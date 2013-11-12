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

$booking;

require("./models/model.php");
function bookingController()
{
	global $rooms;
	global $booking;
	if(isset($_GET["ac"]) &&  $_GET["ac"] == "bookMeeting"){
		$_SESSION['view'] = 'bookMeeting';	
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "bookAMeeting") {
	    $overlap = checkSchedule($_POST["starttime"]."01", $_POST["endtime"]."01", $_POST["date"],$_POST["rID"]);
        if ($overlap == 0) {
            echo ($overlap);
		    $updatedAt = date("Y-m-d");
            $starttime = $_POST["starttime"]."00";
            $endtime = $_POST["endtime"]."00";
            bookAMeeting($_POST["title"],$starttime,$endtime,$_POST["date"],$_POST["rID"],$_POST["uID"],$_POST["attendees"], $updatedAt);
            $rooms = availRooms();
            $_SESSION['view'] = 'frontpage';
        }
        else {
            echo "<script language=javascript>alert('Room is busy. Please pick another room.');
             window.location = 'index.php?c=booking&ac=bookMeeting&view=bookMeeting'; </script>";
            $_SESSION['view'] = 'bookMeeting';
        }    
	}
	else if(isset($_POST["ac"]) &&  $_POST["ac"] == "modifyBooking") {
	    $_SESSION['view'] = $_POST['view'];
    	$rID = checkrID($_POST["room"]);
    	$starttime = convertTime($_POST["starttime"]);
        $endtime = convertTime($_POST["endtime"]);
    	$booking =  array($_POST["title"],$rID,$starttime,$endtime,$_POST["date"],$_POST["attendees"],$_POST["bID"], $_POST["uID"]);      
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "modifyAMeeting") {
	    $overlap = checkSchedule($_POST["starttime"]."01", $_POST["endtime"]."01", $_POST["date"],$_POST["rID"]);
        if ($overlap == 0) {
            $starttime = $_POST["starttime"]."00";
            $endtime = $_POST["endtime"]."00";
            modifyBooking($_POST["bID"], $_POST["title"], $_POST["rID"], $starttime, $endtime, $_POST["date"], $_POST["attendees"]);
            $rooms = availRooms();
            $_SESSION['view'] = 'frontpage';
        }
        else {
            echo "<script language=javascript>alert('Room is busy. Please pick another room.');
             window.location = 'index.php'; </script>";
            $_SESSION['view'] = 'bookMeeting';
        }    
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
function checkSchedule($startt,$endt,$mdate,$rID) {
    return checkOverlap($startt,$endt,$mdate,$rID);
}
function checkrID($room) {
    if ($room == "Main") {
        return 1;
    }
    else if ($room == "HR") {
        return 2;
    }
    else if ($room == "Operation") {
        return 3;
    }
    else if ($room == "Sales") {
        return 4;
    }
    else if ($room == "Engineering") {
        return 5;
    }
    else return 0;
}
function convertTime($time) {
    $timeArr = explode(':', $time);
    return $timeArr[0].$timeArr[1];
}

?>