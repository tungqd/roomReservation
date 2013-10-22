<h2><a href=index.php>Kingkong Conference Room Reservation System</a> - Lookup My Meetings</h2>
<table id="userMeetings">
<tr>
	<th>Title</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Date</th>
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
			$attendees = $meeting[4];
			$status = $meeting[5];
			?>
			<td><?php echo $title;?></td>
			<td><?php echo $starttime;?></td>
			<td><?php echo $endtime;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $attendees;?></td>
			<td><?php echo $status;?></td>
		</tr>
	<?php
	}
?>
	
</table>
