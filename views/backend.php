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
<h1><a href=index.php> Kingkong Room Reservation System</a> - Administrator Panel </h1>
<div>
    <form onSubmit="return validate();" action="index.php?c=admin" id="lookupUserMeetings" method="POST"> 
		<input type="hidden" name="view" value="userLookup">
		<input type="hidden" name="ac" value="lookupMeetings">
		User ID: <input type="text" name="uID">
    	<input type="submit" value="Lookup User Meetings">
	</form>
</div>

<script type="text/javascript">
	function validate()
	{
		var x=document.getElementById("lookupUserMeetings");
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