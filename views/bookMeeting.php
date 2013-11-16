<h1><a href=index.php>Kingkong Room Reservation</a> - Book A Room </h1>
<?php 
    global $closedRooms;
    global $roomCapacity;
    if (isset($_SESSION["overload"]) && $_SESSION["overload"] == true) {
?>
    <div id="roomCapacity">
    <table>
        <tr>
            <th>Name</th>
            <th>Capacity</th>
        </tr>
                <?php
                	for ($i=0; $i < count($roomCapacity); $i++) {
                ?>
                		<tr>
                		<?php
                			$room = $roomCapacity[$i];
                			$name = $room[0];
                			$capacity = $room[1];
                			?>
                			<td><?php echo $name;?></td>
                			<td><?php echo $capacity;?></td>
                		</tr>
                	<?php
                	}
                ?>
    </table>
    </div>
<?php
    }
?>

<form onSubmit="return validate();" action="index.php?c=booking" id="bookAMeeting" method="POST"> 
		<input type="hidden" name="ac" value="bookAMeeting"><br/>
		<label class="blabel">User ID: </label><input type="text" name="uID"><br/>
		<label class="blabel">Title: </label><input type="text" name="title"><br/>
		<label class="blabel">Room: </label><select name="rID">
		    <?php if ($closedRooms[0] == "open") { ?>
		 	<option value="001">Main Conference Room</option>
		 	<?php } if ($closedRooms[1] == "open") { ?>
				<option value="002">HR Conference Room</option>
            <?php } if ($closedRooms[2] == "open") { ?>
				<option value="003">Operation Conference Room</option>
            <?php } if ($closedRooms[3] == "open") { ?>
				<option value="004">Sales Conference Room</option>
            <?php } if ($closedRooms[4] == "open") { ?>
				<option value="005">Engineering Conference Room</option>
            <?php } ?>    
			</select><br/>
		<label class="blabel">Start time: </label><input type="text" name="starttime" value="hhmm"><br/>
		<label class="blabel">End time: </label><input type="text" name="endtime" value="hhmm"><br/>
		<label class="blabel">Date: </label><input type="text" name="date" value="yyyy-mm-dd"><br/>
		<label class="blabel">Number of attendees: </label><input type="text" name="attendees"><br/>
    	<label class="blabel"><input type="submit" value="Book a Meeting"></label>
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
		
		getBiggerRoom($attendees)
		 	
	}
</script>	