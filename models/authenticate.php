<?php
/**
* authenticate.php
*
* Authenticate is a model for controller login.php
*
* @author   Tung Dang
*
*
*/
/**
Verifies if username is "pat" and password id "secret"
*/
function verifyUser($uID, $pw)
{
	return $uID == "admin" && $pw == "kingkong";
}

/**
sets the session variable
*/
function setSessionVariable()
{
	$_SESSION['loggedIn'] = true;
}

/**
destroys the session variable
*/
function destroySession()
{
	session_destroy();
}

?>






