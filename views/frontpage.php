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
	<form onSubmit="return validate();" action="index.php?c=main" id="lookupMeetings" method="POST"> 
		<input type="hidden" name="view" value="userLookup">
		<input type="hidden" name="ac" value="lookupMeetings">
		User ID: <input type="text" name="uID">
    	<input type="submit" value="Lookup My Meetings">
	</form>
	</div>
</div>
<div id="loginButton">
        <form action="index.php" method="GET">
            <input type="hidden" name="c" value="login">
            <input type="hidden" name="view" value="loginscreen">
            <input type="hidden" name="ac" value="login">
            <input type="submit" value="Administrator Login">
        </form>
</div>

<div class="availRooms">
    
	<h3>Current Available Room: </h3>
	<?php 
		for($i=0; $i < count($rooms); $i++) {
			print $rooms[$i]. "<br/>";
	} ?>
	<br/><br/>
	<div>
	<form action="index.php" id="bookAMeeting" method="GET">
	    <input type="hidden" name="c" value="booking"> 
		<input type="hidden" name="ac" value="bookMeeting">
		<input type="hidden" name="view" value="bookMeeting">
    	<input type="submit" value="Book a Meeting">
	</form>
	</div>
</div>
</div>

<script type="text/javascript">
	function validate()
	{
		var x=document.getElementById("lookupMeetings");
		var validate;
		for (var i=0; i<x.length; i++)
		{
			var val = x.elements[i].value;
			if (val == null || val ==='')
			{
				validate = false;
				break;
			}
			validate = true;		
		}
		if (validate) 
		{
			return true;
		}
		else {
			alert("Please fill out your userID");
			return false;
		}
		 	
	}
</script>	