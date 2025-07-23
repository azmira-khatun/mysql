<?php
$conn = mysqli_connect('localhost', 'root', '', 'table_users');

if (isset($_GET['id'])) {
    $getid = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $getid";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    $id = $data['id'];
$name = $data['username']; 
$password = $data['spassword'];
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['spassword'];

    $sql1 = "UPDATE users SET 
                name = '$name', 
                spassword = '$password' 
             WHERE id = '$id'";

    if (mysqli_query($conn, $sql1)) {
        header('Location: view2.php');
        exit(); 
    } else {
        echo "Error: " . mysqli_error($conn);
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
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> 
    ID:<br>
    <input type="text" name="id" value="<?php echo $id ?>" readonly><br><br>
    
    Name:<br>
    <input type="text" name="name" value="<?php echo $name ?>"><br><br>
    
    Password:<br>
    <input type="password" name="spassword" value="<?php echo $password ?>"><br><br>
    
    <input type="submit" name="edit" value="Edit" class="btn btn-success">
</form>

            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</body>

</html>