<?php
$db=mysqli_connect('localhost','root','','table_users');
if(isset($_POST['submit'])){
    $n=$_POST['susername'];
    
    $c=$_POST['spassword'];
// $db->query("call call_users('$n','$c')");

$result = $db->query("CALL call_users('$n','$c')");
if ($result) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $db->error;
}

}


?>


<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
   <div class="container"> 
    <div class="row"> 
        <div class="col-sm-3"></div>
        <div class="col-sm-6 pt-4 mt-4 border border-success"> 
        <form method="POST"> 
        Name:<br>
        <input type ="text" name ="susername"><br><br>
        Password:<br>
        <input type ="text" name ="spassword"><br><br>
        <input type ="submit" name ="submit" value="insert" class="btn btn-success">
        </form>
        </div>
    </div>
   </div>
</body>
</html>