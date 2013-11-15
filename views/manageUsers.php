<?php
/**
* frontpage.php
*
* front page view
*
* @author   Tung Dang
*
*
*/
?>
<h1><a href=index.php?c=admin> Kingkong Room Reservation System</a> - Administrator Panel </h1>
<div id="logoutButton">
        <form action="index.php" method="GET">
            <input type="hidden" name="c" value="login">
            <input type="hidden" name="view" value="frontpage">
            <input type="hidden" name="ac" value="logout">
            <input type="submit" value="Administrator Logout">
        </form>
</div>
<div id="wrapper">
    <div>
        <form action="index.php" id="lookupUserMeetings" method="GET">
            <input type="hidden" name="c" value="admin"> 
            <input type="hidden" name="view" value="adminLookup">
            <input type="hidden" name="ac" value="lookupUserMeetings">
            <input type="submit" value="Lookup User Meetings">
        </form>
    </div>
    <br/><br/>
    <div>
        <form action="index.php" id="userManagement" method="GET">
            <input type="hidden" name="c" value="admin"> 
            <input type="hidden" name="view" value="userManagement">
            <input type="hidden" name="ac" value="manageUsers">
            <input type="submit" value="Manage Users">
        </form>
    </div>
</div>
