<?php
$db =mysqli_connect('localhost','root','','home_db');
if(isset($_POST['submit'])){
    $n=$_POST['sname'];
    $e=$_POST['scontact'];
    $s=$_POST['address'];

$sql="INSERT INTO manufacture(name,contact_no,address) VALUES ('$n','$e','$s')";

if(mysqli_query($db,$sql) == TRUE){
    echo "DATA INSERTED !";
    header ('location:table_view.php');
}else{
    echo "NOT INSERTED !";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<div style="background-color: lavender; width: 30%; margin-left: 20px;">
    <body >
    <form  method="POST">
        <fieldset>
            <legend style = "text-align:center">Information Form</legend>
            name: <br>
            <input type="text" name="sname"> <br> <br> 
            Contact : <br>
            <input type="number" name="scontact"> <br> <br>
            Address: <br>
            <input type="text" name="address"> <br> <br>
        <input type="submit" name="submit" value="submit">
        </fieldset>
    </form>
</div>    
</body>
</html>



