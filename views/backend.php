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
global $rooms;
global $closedRooms;
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
    <div>
        <form action="index.php" id="pullStats" method="GET">
            <input type="hidden" name="c" value="admin"/> 
            <input type="hidden" name="view" value="statistics"/>
            <input type="hidden" name="ac" value="pullStats"/>
            <input type="submit" value="See statistics"/>
            <input type="text" size="2" name="days" value='7'/><label>Days</label>
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
    <br/>
    <h3>Manage Conference Rooms</h3>
    <div>
        <table id="conferenceRooms">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
                <?php
                	for ($i=0; $i < count($rooms); $i++) {
                ?>
                		<tr>
                		<?php
                			$room = $rooms[$i];
                			$id = $room[0];
                			$name = $room[1];
                			$location = $room[2];
                			$capacity = $room[3];
                			$status = $room[4];
                			?>
                			<td><?php echo $id;?></td>
                			<td><?php echo $name;?></td>
                			<td><?php echo $location;?></td>
                			<td><?php echo $capacity;?></td>
                			<td><?php echo $status;?></td>
                			<td>
                			    <?php if ($status == "open") { ?>
                    			    <form onSubmit="return confirmation();" action="index.php?c=admin" id="closeRoom" method="POST">
                                        <input type="hidden" name="ac" value="closeRoom"/>
                                        <input type="hidden" name="view" value="backend"/>
                                        <input type="hidden" name="rID" value=<?php echo $id;?> />    
                                        <input type="submit" value="Close"/>
                                    </form>
                                <?php 
                                    } else {
                                ?>
                                        <form onSubmit="return confirmation();" action="index.php?c=admin" id="openRoom" method="POST">
                                        <input type="hidden" name="ac" value="openRoom"/>
                                        <input type="hidden" name="view" value="backend"/>
                                        <input type="hidden" name="rID" value=<?php echo $id;?> />    
                                        <input type="submit" value="Open"/>
                                    </form>

                                <?php } ?>
                			</td>
                		</tr>
                	<?php
                	}
                ?>
        </table>
    </div>
    <br/>
    <h3>Backup</h3>
    <div>
        <form action="index.php" id="archive" method="GET">
            <input type="hidden" name="c" value="admin"/> 
            <input type="hidden" name="view" value="backend"/>
            <input type="hidden" name="ac" value="archive"/>
            <input type="submit" value="Archive Bookings"/>
            <label>Date:</label><input type="text" size="7" name="date" value="<?php echo date("Y-m-d"); ?>"/>
        </form>
    </div>
</div>
