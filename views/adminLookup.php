<h2><a href=index.php?c=admin>Kingkong Conference Room Reservation System</a> - Lookup My Meetings</h2>
<?php 
    global $userData;
    if (count($userData) == 0) echo "You don't have any bookings yet.";
    else {
?>
<table id="userMeetings">
<tr>
    <th>Booking ID </th>
    <th>User ID</th>
	<th>Title</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Date</th>
	<th>Room</th>
	<th>Number of attendees </th>
	<th>Status</th>
	<th>Action</th>
</tr>

<?php
    
	for ($i=0; $i < count($userData); $i++) {
?>
		<tr>
		<?php
			$meeting = $userData[$i];
			$title = $meeting[0];
			$starttime = $meeting[1];
			$endtime = $meeting[2];
			$date = $meeting[3];
			$room = $meeting[4];
			$attendees = $meeting[5];
			$status = $meeting[6];
			$bID = $meeting[7];
			$uID = $meeting[8];
			?>
			<td><?php echo $bID;?></td>
			<td><?php echo $uID;?></td>
			<td><?php echo $title;?></td>
			<td><?php echo $starttime;?></td>
			<td><?php echo $endtime;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $room;?></td>
			<td><?php echo $attendees;?></td>
			<td><?php echo $status;?></td>
			<td>
    			<form action="index.php?c=booking" id="modifyBooking" method="POST">
                    <input type="hidden" name="ac" value="adminModifyBooking"/>
                    <input type="hidden" name="view" value="adminModifyBooking"/>
                    <input type="hidden" name="title" value=<?php echo $title;?> />
                    <input type="hidden" name="starttime" value=<?php echo $starttime;?> />
                    <input type="hidden" name="endtime" value=<?php echo $endtime;?> />
                    <input type="hidden" name="date" value=<?php echo $date;?> />
                    <input type="hidden" name="room" value=<?php echo $room;?> />
                    <input type="hidden" name="attendees" value=<?php echo $attendees;?> />
                    <input type="hidden" name="bID" value=<?php echo $bID;?> />
                    <input type="hidden" name="uID" value=<?php echo $uID;?> />
                    <input type="hidden" name="status" value=<?php echo $status;?> />
                    <input type="submit" value="Modify"/>
                </form>
			</td>
		</tr>
	<?php
	}   
	}
?>
	
</table>
