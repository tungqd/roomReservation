<?php
/**
* booking.php
*
* booking controller
*
* @author   Kingkong
*
*
*/

$booking;
$roomCapacity;
require("./models/model.php");
/**
*
* bookingController
*/
function bookingController()
{
	global $rooms;
	global $booking;
	global $adminBooking;
	global $data;
	global $closedRooms;
	global $roomCapacity;
	$closedRooms = getRoomStatus();
	$roomCapacity = displayRoomCapacity();
	if(isset($_GET["ac"]) &&  $_GET["ac"] == "bookMeeting"){
		$_SESSION['view'] = 'bookMeeting';
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "bookAMeeting") {
	    $overload = checkCapacity($_POST["rID"], $_POST["attendees"]);
	    $overlap = checkSchedule($_POST["starttime"]."01", $_POST["endtime"]."01", $_POST["date"],$_POST["rID"]);
        if ($overlap == 0 && $overload == 0) {
            echo ($overlap);
		    $updatedAt = date("Y-m-d");
            $starttime = $_POST["starttime"]."00";
            $endtime = $_POST["endtime"]."00";
            bookAMeeting($_POST["title"],$starttime,$endtime,$_POST["date"],$_POST["rID"],$_POST["uID"],$_POST["attendees"], $updatedAt);
            $rooms = availRooms();
            $_SESSION['view'] = 'frontpage';
        }
        else if ($overload != 0) {
            $_SESSION["overload"] = true;
            echo "<script language=javascript>alert('Room is too small. Please pick another room.');
            window.location = 'index.php?c=booking&ac=bookMeeting&view=bookMeeting'; </script>";
            $_SESSION['view'] = 'bookMeeting';
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
        $title = $_POST["title"];
    	$booking =  array($title,$rID,$starttime,$endtime,$_POST["date"],$_POST["attendees"],$_POST["bID"], $_POST["uID"]);      
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "modifyAMeeting") {
	    $overload = checkCapacity($_POST["rID"], $_POST["attendees"]);
	    $overlap = checkSchedule($_POST["starttime"]."01", $_POST["endtime"]."01", $_POST["date"],$_POST["rID"]);
        if ($overlap == 0 && $overload == 0) {
            $starttime = $_POST["starttime"]."00";
            $endtime = $_POST["endtime"]."00";
            modifyBooking($_POST["bID"], $_POST["title"], $_POST["rID"], $starttime, $endtime, $_POST["date"], $_POST["attendees"]);
            $rooms = availRooms();
            if ($_SESSION['loggedIn']) {
                $_SESSION['view'] = 'backend';
            }
            else {
                $_SESSION['view'] = 'frontpage';
            }
        }
        else if ($overload != 0) {
            echo "<script language=javascript>alert('Room is too small. Please pick another room.');
            window.location = 'index.php?c=booking&ac=bookMeeting&view=bookMeeting'; </script>";
            $_SESSION['view'] = 'bookMeeting';
        }
        else {
            echo "<script language=javascript>alert('Room is busy. Please pick another room.');
             window.location = 'index.php'; </script>";
            $_SESSION['view'] = 'bookMeeting';
        }    
	}
	else if(isset($_POST["ac"]) &&  $_POST["ac"] == "adminModifyBooking") {
	    $_SESSION['view'] = $_POST['view'];
    	$rID = checkrID($_POST["room"]);
    	$starttime = convertTime($_POST["starttime"]);
        $endtime = convertTime($_POST["endtime"]);
    	$adminBooking =  array($_POST["title"],$rID,$starttime,$endtime,$_POST["date"],$_POST["attendees"],$_POST["bID"], $_POST["uID"], $_POST["status"]);      
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "adminModifyAMeeting") {
	    $overlap = checkSchedule($_POST["starttime"]."01", $_POST["endtime"]."01", $_POST["date"],$_POST["rID"]);
        if ($overlap == 0) {
            $starttime = $_POST["starttime"]."00";
            $endtime = $_POST["endtime"]."00";
            adminModifyBooking($_POST["bID"], $_POST["title"], $_POST["rID"], $starttime, $endtime, $_POST["date"], $_POST["attendees"], $_POST["status"]);
            $rooms = availRooms(); 
            $_SESSION['view'] = 'backend';
        }
        else {
            echo "<script language=javascript>alert('Room is busy. Please pick another room.');
             window.location = 'index.php'; </script>";
            $_SESSION['view'] = 'adminModifyBooking';
        }    
	}
	else if (isset($_POST["ac"]) &&  $_POST["ac"] == "deleteBooking") {
	    if (deleteBooking($_POST['bID'])) {
    	    echo "<script language=javascript>alert('Booking has been deleted.');</script>";
	    }
	    else {
    	    echo "<script language=javascript>alert('Booking cannot be deleted.');</script>";
	    }
	    $_SESION['view'] = $_POST["view"];
	    $data = getUserMeetings($_POST["uID"]);   
	}	
	else{
        $_SESSION["overload"] = false;
		$_SESSION['view'] = 'frontpage';
	}
}
/**
*
* Book meeting
*/
function bookAMeeting($title, $starttime, $endtime, $date, $rID, $uID, $attendees, $updatedAt) {
	if ($uID <=200) {
		$status = "confirmed";
	}
	else {
		$status = "tentative";
	}
	addAMeeting($title, $starttime, $endtime, $date, $rID, $uID, $attendees, $status, $updatedAt);
}
/**
*
* Check for overlapped booking
*/
function checkSchedule($startt,$endt,$mdate,$rID) {
    return checkOverlap($startt,$endt,$mdate,$rID);
}
/**
*
* convert Room name to rID
*/
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
/**
* 
* convert Time to string
*/
function convertTime($time) {
    $timeArr = explode(':', $time);
    return $timeArr[0].$timeArr[1];
}
?>