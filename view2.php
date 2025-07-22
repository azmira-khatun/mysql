<?php
$db=mysqli_connect("localhost","root","","table_users");
?>


<div>
    <h3 style="text-align: center;color:blue;">User information</h3>
    <table border="1" style="border-collapse: collapse; background-color:white; height120px;border-radius:10px; margin:10px auto;text-aline:center:">
<tr>
    <th>Id</th>
        <th>userName</th>
    <th>password</th>
    <th>Delete</th>

</tr>
<?php
$users=$db->query("select * from users");
while(list($_id,$_name,$_password,$_delete)=$users->fetch_row()){
    echo "<tr>
    <td>$_id</td>
    <td>$_name</td>
    <td>$_password</td>
    <td>$_delete</td>
</td>";

}
?>

    </table>
</div>