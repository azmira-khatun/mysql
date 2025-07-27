<?php
// Database connection
$db = new mysqli('localhost', 'root', '', 'company_db');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Brand FORM Submit
if (isset($_POST['submit_brand'])) {
    $name = $db->real_escape_string($_POST['bname']);
    $email = $db->real_escape_string($_POST['bemail']);
    $contact = $db->real_escape_string($_POST['bcontact']);

    $db->query("INSERT INTO brand (name, email, contact) VALUES ('$name', '$email', '$contact')");
}

// Product 
if (isset($_POST['submit_product'])) {
    $name = $db->real_escape_string($_POST['pname']);
    $price = $db->real_escape_string($_POST['pprice']);
    $brand_id = $db->real_escape_string($_POST['brand_id']);

    $db->query("INSERT INTO product (name, price, brand_id) VALUES ('$name', '$price', '$brand_id')");
}

// JOIN query
$query = "SELECT 
            product.id AS product_id,
            product.name AS product_name,
            product.price,
            brand.id AS brand_id,
            brand.name AS brand_name,
            brand.email,
            brand.contact
          FROM product
          JOIN brand ON product.brand_id = brand.id";

$result = $db->query($query);

// Sob brabd anci dropdown ar jnno
$brands = $db->query("SELECT * FROM brand");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Brand & Product Entry</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { margin-bottom: 30px; }
        input, select {
            padding: 8px; margin: 5px 0; width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        th { background-color: #f2f2f2; }
        .form-box { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; }
    </style>
</head>
<body>


<fieldset style="width:250px; background-color: #fff;margin:10px auto;float:left;">
<h2>Brand</h2>
<div class="form-box">
    <form method="post">
        <input type="text" name="bname" placeholder="Brand Name" required>
        <input type="email" name="bemail" placeholder="Brand Email" required>
        <input type="text" name="bcontact" placeholder="Contact Number" required><br><br>
        <button type="submit" name="submit_brand">Add Brand</button>
    </form>
</div>
</fieldset>




<fieldset style="width:250px; background-color: #fff;margin:10px auto;float:left;">

<h2>Product</h2>
<div class="form-box">
    <form method="post">
        <input type="text" name="pname" placeholder="Product Name" required>
        <input type="number" name="pprice" placeholder="Price" required>
        <select name="brand_id" required>
            <option value="">-- Select Brand --</option>
            <?php while($row = $brands->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <button type="submit" name="submit_product">Add Product</button>
    </form>
</div>
</fieldset>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div>
<h2> Show Product & Brand Data </h2>
<table>
    <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Brand Name</th>
        <th>Email</th>
        <th>Contact</th>
    </tr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['brand_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['contact'] ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No data here</td></tr>
    <?php endif; ?>
</table>
</div>




<!-- view-condition -->

<div>
<h2> Condition view </h2>
<table>
    <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Brand Name</th>
        <!-- <th>Email</th>
        <th>Contact</th> -->
    </tr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['brand_name'] ?></td>
                <!-- <td><?= $row['email'] ?></td>
                <td><?= $row['contact'] ?></td> -->
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">No data here</td></tr>
    <?php endif; ?>
</table>
</div>

</body>
</html>
