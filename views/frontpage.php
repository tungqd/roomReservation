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
<h1><a href=index.php> Welcome to Kingkong Room Reservation System</a> </h1>
<div class="wrapper">
<div class="meetings">
	<div id="col">
	<form action="index.php?c=main" id="lookupARoom" method="POST"> 
		<input type="hidden" name="ac" value="lookupARoom">
		<select name="room">
				<option value="001">Main Conference Room</option>
				<option value="002">HR Conference Room</option>
				<option value="003">Operation Conference Room</option>
				<option value="004">Sales Conference Room</option>
				<option value="005">Engineering Conference Room</option>
		</select>
    	<input type="submit" value="Lookup Room Schedule">
	</form>
	</div>
	<br/><br/>
	<div>
	<form action="index.php?c=main" id="lookupMeetings" method="POST"> 
		<input type="hidden" name="view" value="userLookup">
		<input type="hidden" name="ac" value="lookupMeetings">
		User ID: <input type="text" name="uID">
    	<input type="submit" value="Lookup My Meetings">
	</form>
	</div>
</div>
<div class="availRooms">
	
	<h3>Current Available Room: </h3>
	<?php 
		for($i=0; $i < count($rooms); $i++) {
			print $rooms[$i]. "<br/>";
	} ?>
	<br/><br/>
	<div>
	<form action="index.php?c=booking" id="bookAMeeting" method="POST"> 
		<input type="hidden" name="ac" value="bookMeeting">
		<input type="hidden" name="view" value="bookMeeting">
    	<input type="submit" value="Book a Meeting">
	</form>
	</div>
</div>
</div>