<?php
$conn = mysqli_connect('localhost', 'root', '', 'table_users');

// Edit form data load
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $sql = "SELECT * FROM users WHERE id = $edit_id";
    $query = mysqli_query($conn, $sql);
    $edit_data = mysqli_fetch_assoc($query);
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $spassword = $_POST['spassword'];

    $sql_update = "UPDATE users SET 
                    username = '$username', 
                    spassword = '$spassword' 
                   WHERE id = '$id'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Updated successfully!'); window.location.href='".$_SERVER['PHP_SELF']."';</script>";
        exit();
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View & Edit Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <h2>User Table</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th><th>Name</th><th>Password</th><th>Action</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['spassword']}</td>
                    <td><a href='?edit_id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a></td>
                  </tr>";
        }
        ?>
    </table>

    <?php if (isset($edit_data)) { ?>
        <h3>Edit User ID: <?php echo $edit_data['id']; ?></h3>
        <form method="POST" class="border p-3">
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="username" value="<?php echo $edit_data['username']; ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="text" name="spassword" value="<?php echo $edit_data['spassword']; ?>" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    <?php } ?>

</div>
</body>
</html>
