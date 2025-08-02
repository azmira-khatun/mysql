<?php
$db=mysqli_connect("localhost","root","","home_db");
?>


<div>
    <h3 style="text-align: center;color:blue;">User information</h3>
    <table border="1" style="border-collapse: collapse; background-color:white; height120px;border-radius:10px; margin:10px auto;text-aline:center:">
<tr>
    <th>Id</th>
        <th>Name</th>
    <th>Contact</th>
    <th>Address</th>

</tr>
<?php
$users=$db->query("select * from manufacture");
while(list($_id,$_name,$_contact,$_address)=$users->fetch_row()){
    echo "<tr>
    <td>$_id</td>
    <td>$_name</td>
    <td>$_contact</td>
    <td>$_address</td>
</td>";

}
?>

    </table>
</div>