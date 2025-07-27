<?php 
$db = new mysqli('localhost','root','','company_db');

if(isset($_POST['btnSubmit'])){
	$name = $_POST['mname'];
	$email=$_POST['email'];
	$contact = $_POST['contact'];
	$db->query(" call catagori('$name','$email','$contact') ");




if(!$db){
	echo "not store";
}else{
	echo "data store";
}
}


if(isset($_POST['addProduct'])){
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$brandd=&$_POST['manufac'];
	// $mid = $_POST['manufac'];
	$db->query(" call GETproductBYname('$pname','$price','$brandd') ");
}

if(isset($_POST['delmanufact'])){
	$mid = $_POST['manufac'];
	$db->query(" delete from manufacturer where id='$mid ' ");
}


?>
<fieldset style="background-color:aqua;margin:10px auto; width: 150px;float:left;">
<h3>BRAND table</h3>
<form action="#" method="post">
	<table>
		<tr>
			<td><label for="mname">Name</label></td>
			<td><input type="text" name="mname" /></td>
		</tr>
		<tr>
			<td><label for="email">Email</label></td>
			<td><input type="text" name="email" /></td>
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
</fieldset>

<fieldset style="background-color:aqua;margin:10px auto; width: 120px;float:left;">

<h3>Product table</h3>
<form action="#" method="post">
	<table>
		<tr>
			<td><label for="pname">Name</label></td>
			<td><input type="text" name="pname" /></td>
		</tr>
		<tr>
			<td><label for="price">Price</label></td>
			<td><input type="text" name="price" /></td>
		</tr>
		<tr>
			<td><label for="manufac">BRAND Name</label></td>
			<td>
				<select name="manufac">
					<?php 
						$manufac = $db->query("select * from brand");
						while(list($_brandd,$_name) = $manufac->fetch_row()){
							echo "<option value='$_brandd'>$_name</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr> 
			<td></td>
			<td><input type="submit" name="addProduct" value="submit" /></td>
		</tr>
	</table>
</form>
</fieldset>

<!-- after delete trigger -->
<form action="#" method="post">
	<table>
		<tr>
			<td><label for="manufac">Manufacturer</label></td>
			<td>
				<select name="manufac">
					<?php 
						$manufac = $db->query("select * from manufacturer");
						while(list($_mid,$_mname) = $manufac->fetch_row()){
							echo "<option value='$_mid'>$_mname</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr> 
			<td></td>
			<td><input type="submit" name="delmanufact" value="delete" /></td>
		</tr>
	</table>
</form>



<h3>View Product</h3>

<table border="1" style="border-collapse: collapse;" > 
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Price</th>
		<th>Manufacturer</th>
		<th>Contact</th>
	</tr>
	<?php 
		$product = $db->query(" select * from view_product ");
		while(list($_id,$_name,$_price,$_mname,$_mcont) = $product->fetch_row()){
			echo "<tr> 
					<td>$_id</td>
					<td>$_name</td>
					<td>$_price</td>
					<td>$_mname</td>
					<td>$_mcont</td>
				</tr>";
		}
	
	?>
</table>

<br>
<h3>View Product</h3>

<table border="1" style="border-collapse: collapse;" > 
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Price</th>
		<th>Manufacturer</th>
		<th>Contact</th>
	</tr>
	<?php 
		$product = $db->query(" select * from select_product ");
		while(list($_id,$_name,$_price,$_mname,$_mcont) = $product->fetch_row()){
			echo "<tr> 
					<td>$_id</td>
					<td>$_name</td>
					<td>$_price</td>
					<td>$_mname</td>
					<td>$_mcont</td>
				</tr>";
		}
	
	?>
</table>