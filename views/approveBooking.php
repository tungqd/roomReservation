<h2><a href=index.php?c=admin>Kingkong Conference Room Reservation System</a> - Approve Tentative Booking</h2>
<?php 
    global $tentativeBooking;
    if (count($tentativeBooking) == 0) echo "There is no tentative booking.";
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
    
	for ($i=0; $i < count($tentativeBooking); $i++) {
?>
		<tr>
		<?php
			$meeting = $tentativeBooking[$i];
			$bID = $meeting[0];
			$title = $meeting[1];
			$starttime = $meeting[2];
			$endtime = $meeting[3];
			$date = $meeting[4];
			$rID = $meeting[5];
			$uID = $meeting[6];
			$attendees = $meeting[7];
			$status = $meeting[8];
			?>
			<td><?php echo $bID;?></td>
			<td><?php echo $title;?></td>
			<td><?php echo $starttime;?></td>
			<td><?php echo $endtime;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $rID;?></td>
			<td><?php echo $uID;?></td>
			<td><?php echo $attendees;?></td>
			<td><?php echo $status;?></td>
			<td>
    			<form action="index.php?c=admin" id="approveBooking" method="POST">
    			    <input type="hidden" name="ac" value="approveABooking"/>
    			    <input type="hidden" name="id" value="<?php echo $bID;?>"/>
                    <input type="submit" value="Approve"/>
                </form>
			</td>
		</tr>
	<?php
	}   
	}
?>
	
</table>
