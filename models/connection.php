<?php
require_once('./config/config.php');
$mysql_hostname = HOST;
$mysql_user = USERNAME;
$mysql_password = PASSWORD;
$mysql_database = DATABASE;
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

?>