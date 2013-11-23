<?php
/**
* login.php
*
* Controller for handling adminstrator login 
*
* @author   Kingkong
*
*
*/
require_once "./models/authenticate.php";
require_once "./models/model.php";
/**
*
* Login controller
*/
function loginController()
{
    global $rooms;
	//Login form is submitted
	if (isset($_POST["ac"]) && $_POST["ac"]=="log") {
     	if (verifyUser($_POST["userid"],$_POST["pw"])) {
			if (isset($_SESSION["Usage"])) {
				unset($_SESSION["Usage"]);
			}
     		
     		setSessionVariable();
     		$rooms = displayRooms();
          	$_SESSION["view"]=("backend");
     	} 
     	else { 
			$_SESSION["Usage"] = ("error");
          	$_SESSION["view"]=("loginscreen");
     	}
    }
    else if (isset($_GET["ac"]) && $_GET["ac"] == "login") {
    	$_SESSION["view"]=("loginscreen");
    }
    else if (isset($_GET["ac"]) && $_GET["ac"] == "logout") {
		destroySession();
		$_SESSION["view"]=("frontpage");
		$rooms = availRooms();
    }
}


?>

