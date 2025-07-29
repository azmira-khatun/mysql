<?php 
ob_start();
$conn = new mysqli("localhost", "root", "", "exams_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert Manufacturer
if (isset($_POST['submit_manufacturer'])) {
  $name = $_POST['name'];
  $address = $_POST['address'];
  $contact_no = $_POST['contact_no'];
  $sql = "CALL insert_manufacturer('$name', '$address', '$contact_no')";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?added_manufacturer=1&page=view_manufacturer");
    exit;
  } else { echo "Error: " . $conn->error; }
}

// Insert Product
if (isset($_POST['submit_product'])) {
  $pname = $_POST['product_name'];
  $pprice = $_POST['product_price'];
  $mid = $_POST['manufacturer_id'];
  $sql = "CALL insert_product('$pname', $pprice, $mid)";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?added_product=1&page=view");
    exit;
  } else { echo "Error: " . $conn->error; }
}

// Update Product
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $sql = "CALL update_product($id, '$name', $price)";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?updated_product=1&page=view");
    exit;
  } else { echo "Error: " . $conn->error; }
}

// Delete Product
if (isset($_GET['delete_id'])) {
  $id = $_GET['delete_id'];
  $sql = "CALL delete_product($id)";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?deleted_product=1&page=view");
    exit;
  } else { echo "Error: " . $conn->error; }
}

// Delete Manufacturer (Trigger auto deletes related products)
if (isset($_GET['delete_manufacturer_id'])) {
  $id = $_GET['delete_manufacturer_id'];
  $sql = "DELETE FROM manufacturer WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    header("Location: ?deleted_manufacturer=1&page=view_manufacturer");
    exit;
  } else { echo "Error: " . $conn->error; }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>DB Driven Web App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">DB Driven App</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="?page=insert"><i class="fas fa-plus"></i> Add Manufacturer</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=add_product"><i class="fas fa-box"></i> Add Product</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=view"><i class="fas fa-eye"></i> View Products</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=view_manufacturer"><i class="fas fa-industry"></i> View Manufacturers</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($page == 'insert') {
  echo '
  <div class="card p-4 shadow">
    <h2><i class="fas fa-industry"></i> Add Manufacturer</h2>
    <form method="POST">
      <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Address</label><input type="text" name="address" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Contact No</label><input type="text" name="contact_no" class="form-control" required></div>
      <button type="submit" name="submit_manufacturer" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
    </form>
  </div>';
} elseif ($page == 'add_product') {
  $manus = $conn->query("SELECT id, name FROM manufacturer");
  echo '
  <div class="card p-4 shadow">
    <h2><i class="fas fa-box"></i> Add Product</h2>
    <form method="POST">
      <div class="mb-3"><label class="form-label">Product Name</label><input type="text" name="product_name" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Price</label><input type="number" name="product_price" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Select Manufacturer</label>
      <select name="manufacturer_id" class="form-select" required>
        <option value="">-- Select Manufacturer --</option>';
        while ($row = $manus->fetch_assoc()) {
          echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
  echo '</select></div>
      <button type="submit" name="submit_product" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
    </form>
  </div>';
} elseif ($page == 'view') {
  echo '<div class="card p-4 shadow">';
  echo '<h2 class="mb-4">Products &gt; 5000</h2>';

  $res = $conn->query("SELECT * FROM expensive_products");

  if ($res && $res->num_rows > 0) {
    echo "<table class='table table-striped'>
      <thead class='table-dark'>
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Manufacturer</th><th>Action</th></tr>
      </thead><tbody>";
    while ($row = $res->fetch_assoc()) {
      echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['price']."</td>
        <td>".$row['manufacturer_name']."</td>
        <td>
          <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editModal".$row['id']."'>Edit</button>
          <button class='btn btn-sm btn-danger' onclick='deleteRecord(".$row['id'].")'>Delete</button>
        </td></tr>

      <div class='modal fade' id='editModal".$row['id']."' tabindex='-1'>
        <div class='modal-dialog'><div class='modal-content'>
        <form method='POST'>
          <div class='modal-header'><h5 class='modal-title'>Edit Product</h5>
          <button type='button' class='btn-close' data-bs-dismiss='modal'></button></div>
          <div class='modal-body'>
            <input type='hidden' name='id' value='".$row['id']."'>
            <div class='mb-3'><label class='form-label'>Name</label>
            <input type='text' name='name' class='form-control' value='".$row['name']."' required></div>
            <div class='mb-3'><label class='form-label'>Price</label>
            <input type='number' name='price' class='form-control' value='".$row['price']."' required></div>
          </div>
          <div class='modal-footer'>
            <button type='submit' name='update' class='btn btn-success'>Update</button>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
          </div>
        </form></div></div></div>";
    }
    echo "</tbody></table>";
  } else { echo "<div class='alert alert-warning'>No products found.</div>"; }
  echo '</div>';
} elseif ($page == 'view_manufacturer') {
  echo '<div class="card p-4 shadow">';
  echo '<h2 class="mb-4">Manufacturers</h2>';
  $result = $conn->query("SELECT * FROM manufacturer");
  if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>
      <thead class='table-dark'><tr><th>ID</th><th>Name</th><th>Address</th><th>Contact</th><th>Action</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['address']."</td><td>".$row['contact_no']."</td>
      <td><button class='btn btn-sm btn-danger' onclick='deleteManufacturer(".$row['id'].")'>Delete</button></td></tr>";
    }
    echo "</tbody></table>";
  } else { echo "<div class='alert alert-warning'>No manufacturers found.</div>"; }
  echo '</div>';
} else {
  echo '<div class="text-center">
    <h1>Welcome to DB Driven Web App</h1>
    <a href="?page=insert" class="btn btn-primary"><i class="fas fa-plus"></i> Add Manufacturer</a>
    <a href="?page=add_product" class="btn btn-success"><i class="fas fa-box"></i> Add Product</a>
    <a href="?page=view" class="btn btn-info"><i class="fas fa-eye"></i> View Products</a>
    <a href="?page=view_manufacturer" class="btn btn-secondary"><i class="fas fa-industry"></i> View Manufacturers</a>
  </div>';
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function deleteRecord(id) {
  Swal.fire({title:'Are you sure?', text:'Delete this product?', icon:'warning', showCancelButton:true, confirmButtonText:'Yes, delete!'})
  .then((result) => { if(result.isConfirmed) { window.location.href='?delete_id='+id+'&page=view'; } });
}
function deleteManufacturer(id) {
  Swal.fire({title:'Are you sure?', text:'Delete this manufacturer and its products?', icon:'warning', showCancelButton:true, confirmButtonText:'Yes, delete!'})
  .then((result) => { if(result.isConfirmed) { window.location.href='?delete_manufacturer_id='+id+'&page=view_manufacturer'; } });
}
</script>

<?php
if (isset($_GET['added_manufacturer'])) {
  echo "<script>Swal.fire({icon:'success',title:'Manufacturer Added!'});</script>";
}
if (isset($_GET['added_product'])) {
  echo "<script>Swal.fire({icon:'success',title:'Product Added!'});</script>";
}
if (isset($_GET['updated_product'])) {
  echo "<script>Swal.fire({icon:'success',title:'Product Updated!'});</script>";
}
if (isset($_GET['deleted_product'])) {
  echo "<script>Swal.fire({icon:'success',title:'Product Deleted!'});</script>";
}
if (isset($_GET['deleted_manufacturer'])) {
  echo "<script>Swal.fire({icon:'success',title:'Manufacturer Deleted!'});</script>";
}
$conn->close();
ob_end_flush();
?>
</body>
</html>
