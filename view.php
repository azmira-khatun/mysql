<?php
$db=mysqli_connect("localhost","root","","e_commerce");
?>


<div>
    <h3>User information</h3>
    <table border="1" style="border-collapse: collapse;">
<tr>
    <th>Id</th>
        <th>userName</th>
    <th>password</th>

</tr>
<?php
$users=$db->query("select * from users");
while(list($_id,$_name,$_password)=$users->fetch_row()){
    echo "<tr>
    <td>$_id</td>
    <td>$_name</td>
    <td>$_password</td>
</td>";

}
?>

    </table>
</div>