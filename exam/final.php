<?php
$db = new mysqli('localhost', 'root', '', 'company');

// Add Manufacturer
if (isset($_POST['btnSubmit'])) {
    $mname = $_POST['mname'];
    $contact = $_POST['contact'];
    $db->query("CALL add_manufacture('$mname','$contact')");
}

// Add Product
if (isset($_POST['addProduct'])) {
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $manu = $_POST['manufac'];
    $db->query("CALL add_product('$pname', $price, $manu)");
}

// Delete Manufacturer
if (isset($_POST['delmanufact'])) {
    $mid = $_POST['manufac'];
    $db->query("DELETE FROM manufacturer WHERE id = $mid");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manufacturer & Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 20px;
            padding: 20px;
            color: #333;
        }

        .forms-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        form {
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 10px;
            text-align: left;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Product Table */
        table[border="1"] {
            margin-top: 40px;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th {
            background-color: #3498db;
            color: white;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf4fd;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Manufacturer and Product Management</h2>

<div class="forms-container">
    <!-- Add Manufacturer Form -->
    <form method="post">
        <h3>Add Manufacturer</h3>
        <table>
            <tr>
                <td><label>Name</label></td>
                <td><input type="text" name="mname" required /></td>
            </tr>
            <tr>
                <td><label>Contact</label></td>
                <td><input type="text" name="contact" required /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="btnSubmit" value="Add Manufacturer" /></td>
            </tr>
        </table>
    </form>

    <!-- Add Product Form -->
    <form method="post">
        <h3>Add Product</h3>
        <table>
            <tr>
                <td><label>Name</label></td>
                <td><input type="text" name="pname" required /></td>
            </tr>
            <tr>
                <td><label>Price</label></td>
                <td><input type="text" name="price" required /></td>
            </tr>
            <tr>
                <td><label>Manufacturer</label></td>
                <td>
                    <select name="manufac" required>
                        <?php 
                            $manufac = $db->query("SELECT * FROM manufacturer");
                            while(list($_mid,$_mname) = $manufac->fetch_row()){
                                echo "<option value='$_mid'>$_mname</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="addProduct" value="Add Product" /></td>
            </tr>
        </table>
    </form>

    <!-- Delete Manufacturer Form -->
    <form method="post">
        <h3>Delete Manufacturer</h3>
        <table>
            <tr>
                <td><label>Manufacturer</label></td>
                <td>
                    <select name="manufac" required>
                        <?php 
                            $manufac = $db->query("SELECT * FROM manufacturer");
                            while(list($_mid,$_mname) = $manufac->fetch_row()){
                                echo "<option value='$_mid'>$_mname</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="delmanufact" value="Delete Manufacturer" /></td>
            </tr>
        </table>
    </form>
</div>

<!-- Product Table -->
<?php 
$sql ="SELECT * FROM view_product";
$result =mysqli_query($db,$sql); 

if ($result->num_rows > 0) {
    echo "<table border='1' width='80%' align='center'>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Manufacturer</th>
            </tr>";
    while(list($pid, $pname, $price, $mname) = $result->fetch_row()){
        echo "<tr>
                <td align='center'>$pid</td>
                <td>$pname</td>
                <td>$price</td>
                <td>$mname</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No products found.</p>";
}
?>

</body>
</html>