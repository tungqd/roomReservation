<h2><a href=index.php>Kingkong Conference Room Reservation System</a> - Lookup Room Schedule</h2>
<table id="roomSchedule">
<tr>
	<th>Title</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Date</th>
	<th>Organizer</th>
	<th>Number of attendees</th>
</tr>
<?php
	for ($i=0; $i < count($schedules); $i++) {
?>
		<tr>
		<?php
			$meeting = $schedules[$i];
			$title = $meeting[0];
			$starttime = $meeting[1];
			$endtime = $meeting[2];
			$date = $meeting[3];
			$organizer = $meeting[4];
			$attendees = $meeting[5];
			?>
			<td><?php echo $title;?></td>
			<td><?php echo $starttime;?></td>
			<td><?php echo $endtime;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $organizer;?></td>
			<td><?php echo $attendees;?></td>
		</tr>
	<?php
	}
?>
	
</table>
