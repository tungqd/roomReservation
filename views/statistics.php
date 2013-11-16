<h2><a href=index.php?c=admin>Kingkong Conference Room Reservation System</a> - Statistics</h2>
<?php 
    global $userData;
    if (count($userData) == 0) echo "There is no booking!";
    else {
?>
<table id="userMeetings">
<tr>
    <th>Title </th>
    <th>Room</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Date</th>   
	<th>Organizer</th>
	<th>Number of attendees </th>
	<th>Status</th>
</tr>

<?php
    
	for ($i=0; $i < count($userData); $i++) {
?>
		<tr>
		<?php
			$meeting = $userData[$i];
			$title = $meeting[0];
			$room = $meeting[1];
			$starttime = $meeting[2];
			$endtime = $meeting[3];
			$date = $meeting[4];
			$organizer = $meeting[5];
			$attendees = $meeting[6];
			$status = $meeting[7];
			?>
			<td><?php echo $title;?></td>
			<td><?php echo $room;?></td>
			<td><?php echo $starttime;?></td>
			<td><?php echo $endtime;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $organizer;?></td>
			<td><?php echo $attendees;?></td>
			<td><?php echo $status;?></td>
		</tr>
	<?php
	}   
	}
?>
	
</table>

