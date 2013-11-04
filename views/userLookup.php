<h2><a href=index.php>Kingkong Conference Room Reservation System</a> - Lookup My Meetings</h2>
<?php 
    if (count($data) == 0) echo "You don't have any bookings yet.";
    else {
?>
<table id="userMeetings">
<tr>
	<th>Title</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Date</th>
	<th>Room</th>
	<th>Number of attendees </th>
	<th>Status</th>
</tr>

<?php
    
	for ($i=0; $i < count($data); $i++) {
?>
		<tr>
		<?php
			$meeting = $data[$i];
			$title = $meeting[0];
			$starttime = $meeting[1];
			$endtime = $meeting[2];
			$date = $meeting[3];
			$room = $meeting[4];
			$attendees = $meeting[5];
			$status = $meeting[6];
			?>
			<td><?php echo $title;?></td>
			<td><?php echo $starttime;?></td>
			<td><?php echo $endtime;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $room;?></td>
			<td><?php echo $attendees;?></td>
			<td><?php echo $status;?></td>
		</tr>
	<?php
	}   
	}
?>
	
</table>
