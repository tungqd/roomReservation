<?php
/**
* index.php
*
* This file acts as entry point and calls appropriate controllers.
*
* @author   Tung Dang
*
*
*/
session_start();

//require_once('./config/config.php');
// there are 3 controllers
$controllers_available= array('main','booking','admin');

//deciding the controller to be run
if(isset($_GET['c']) && in_array($_GET['c'],$controllers_available)){
	if("main"==$_GET['c']){
		$controller = "main";
	}
	else{
		$controller = $_GET['c'];
	}
}
else{
	$controller = "main";
}

//function pointer to call the controller
$controller();

function main()
{
	//global $BASEURL;
	//$base = echo BASEURL;
	//require_once(defined($BASEURL)."controllers/main.php");
	require_once("./controllers/main.php");
	mainController();
	displayView($_SESSION['view']);
}

function booking()
{
	//global $BASEURL;
	require_once("./controllers/booking.php");
	bookingController();
	displayView($_SESSION['view']);
}

function admin()
{
	//global $BASEURL;
	require_once("./controllers/admin.php");
	//blogController();
	//displayView($_SESSION['view']);
}

//displayView renders and displays specific view
function displayView($viewname)
{
?>
<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Kingkong Room Reservation></title>
<meta name="Authors" content="Tung Dang, Loc Dang, Khanh Nguyen" />
<meta name="description" content="Simple blog using MVC pattern for HW2 CS174" />
<meta name="keywords" content="HW2, blog, MVC" />
<meta charset="utf-8" />
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>
<link rel="stylesheet" type="text/css" href="./css/styles.css" />
</head>
<body>
	
	<?php 
		global $data;
		global $rooms;
		global $schedules;
		require_once("./views/{$viewname}.php"); 
	?>

</body>
</html>
<?php
}
?>