<?php
$db=new mysqli('localhost','root','','home_db');
// SQL query
$sql = "INSERT INTO manufacture (name, address,contact_no) VALUES ('Rahim', 'Dhaka',098765)";

if(isset($_POST['btnSubmit'])){
	$mname = $_POST['mname'];
    $address=$_POST['address'];
	$contact = $_POST['contact'];
	$db->query(" CALL call_manufacture('$mname','$contact') ");

    // Run the query
if (mysqli_query($db, $sql)) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . mysqli_error($db);
}

mysqli_close($db);

}










?>
<h3>INSERT TABLE</h3>
<form action="#" method="post">
	<table>
		<tr>
			<td><label for="mname">Name</label></td>
			<td><input type="text" name="mname" /></td>
		</tr>
        <tr>
			<td><label for="address">Address</label></td>
			<td><input type="text" name="address" /></td>
		</tr>
		<tr>
			<td><label for="contact">Contact</label></td>
			<td><input type="text" name="contact" /></td>
		</tr>
		<tr> 
			<td></td>
			<td><input type="submit" name="btnSubmit" value="submit" /></td>
		</tr>
	</table>
    </form>