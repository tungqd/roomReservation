<h2><a href=index.php?c=admin>Kingkong Conference Room Reservation System</a> - Manage Users</h2>
<?php 
    global $userData;
?>
<div id="wrapper">
<div id="addUser">
<form onSubmit="return validate();" action="index.php?c=admin" id="addAUser" method="POST"> 
		<input type="hidden" name="ac" value="addAUser">		
        <label class="blabel">User ID: </label><input type="text" name="id"/><br/>
        <label class="blabel">Name: </label><input type="text" name="name"/><br/>
        <label class="blabel">Position: </label><input type="text" name="position"/><br/>
        <label class="blabel"><input type="submit" value="Add New User"></label>
</form>
</div>
<div id="displayUser">
<table id="userMeetings">
<tr>
    <th>User ID </th>
    <th>Name</th>
	<th>Position</th>
	<th>Action</th>
</tr>

<?php
    
	for ($i=0; $i < count($userData); $i++) {
?>
		<tr>
		<?php
			$user = $userData[$i];
			$id = $user[0];
			$name = $user[1];
			$position = $user[2];
			?>
			<td><?php echo $id;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $position;?></td>
			<td>
    			<form onSubmit="return confirmation();" action="index.php?c=admin" id="deleteUser" method="POST">
                    <input type="hidden" name="ac" value="deleteUser"/>
                    <input type="hidden" name="view" value="manageUsers"/>
                    <input type="hidden" name="id" value=<?php echo $id;?> />
                    <input type="submit" value="Delete"/>
                </form>
			</td>
		</tr>
	<?php
	}   
?>
</table>
</div>

</div>
<script type="text/javascript">
	function validate()
	{
		var x=document.getElementById("addAUser");
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
			alert("Please fill out all fields");
			return false;
		}		 	
	}
	function confirmation()
	{
	    var x;
        var r=confirm("Are you sure you want to delete this user?");
        if (r==true)
          {
          x=true;
          }
        else
          {
          x=false;
          }
        return x;
	}
</script>