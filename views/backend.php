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
    <h3>Manage Bookings</h3>
    <div>
        <form action="index.php" id="lookupUserMeetings" method="GET">
            <input type="hidden" name="c" value="admin"> 
            <input type="hidden" name="view" value="adminLookup">
            <input type="hidden" name="ac" value="lookupUserMeetings">
            <input type="submit" value="Lookup User Bookings">
        </form>
    </div>
    <br/>
    <div>
        <form action="index.php" id="approveBooking" method="GET">
            <input type="hidden" name="c" value="admin"> 
            <input type="hidden" name="view" value="approveBooking">
            <input type="hidden" name="ac" value="approveBooking">
            <input type="submit" value="Confirm Tentative Bookings">
        </form>
    </div>
    <br/>
    <h3>Manage Users</h3>
    <div>
        <form action="index.php" id="userManagement" method="GET">
            <input type="hidden" name="c" value="admin"> 
            <input type="hidden" name="view" value="manageUsers">
            <input type="hidden" name="ac" value="manageUsers">
            <input type="submit" value="Manage Users">
        </form>
    </div>
</div>
