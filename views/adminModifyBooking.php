<h1><a href=index.php?c=admin>Kingkong Room Reservation</a> - Administrator Modify Booking </h1>
<?php global $adminBooking;?>
<form onSubmit="return validate();" action="index.php?c=booking" id="adminModifyAMeeting" method="POST"> 
		<input type="hidden" name="ac" value="adminModifyAMeeting">		
        <input type="hidden" name="bID" value="<?php echo $adminBooking[6];?>"/><br/>
        <label class="blabel">User ID: </label><input type="text" name="uID" value=<?php echo $adminBooking[7];?> readonly><br/>
		<label class="blabel">Title: </label><input type="text" name="title" value=<?php echo $adminBooking[0];?>><br/>
		<label class="blabel">Room: </label><select name="rID">
				<option value="001" <?php if($adminBooking[1] == '001'){echo("selected");}?> >Main Conference Room</option>
				<option value="002" <?php if($adminBooking[1] == '002'){echo("selected");}?> >HR Conference Room</option>
				<option value="003" <?php if($adminBooking[1] == '003'){echo("selected");}?> >Operation Conference Room</option>
				<option value="004" <?php if($adminBooking[1] == '004'){echo("selected");}?> >Sales Conference Room</option>
				<option value="005" <?php if($adminBooking[1] == '005'){echo("selected");}?> >Engineering Conference Room</option>
			</select><br/>
		<label class="blabel">Start time: </label><input type="text" name="starttime" value=<?php echo $adminBooking[2];?>><br/>
		<label class="blabel">End time: </label><input type="text" name="endtime" value=<?php echo $adminBooking[3];?>><br/>
		<label class="blabel">Date: </label><input type="text" name="date" value=<?php echo $adminBooking[4];?>><br/>
		<label class="blabel">Number of attendees: </label><input type="text" name="attendees" value=<?php echo $adminBooking[5];?>><br/>
		<label class="blabel">Status: </label><input type="text" name="status" value=<?php echo $adminBooking[8];?>><br/>
    	<label class="blabel"><input type="submit" value="Submit"></label>
</form>
<script type="text/javascript">
	function validate()
	{
		var x=document.getElementById("bookAMeeting");
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
			//alert("You booking has been processed successfully.")
			return true;
		}
		else {
			alert("Please fill out all fields");
			return false;
		}
		var uID = x.elements[0];
		var title = x.elements[1];
		var room = x.elements[2];
		var starttime = x.elements[3];
		var endtime = x.elements[4];
		var date = x.elements[5];
		var attendees = x.elements[6];
		 	
	}
</script>	
