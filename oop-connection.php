<h1>
<pre>
    The connect() /mysql_connect() function opens a new connection to the Mysql server.
</pre>

</h1>


<?php
// object system
$hostname="localhost";
$user="root";
$password="";
$dbname="e_commerce";
$conn=new mysqli($hostname,$user,$password,$dbname);

// or
// $conn=new mysqli("localhost","root","","crud-one")
if($conn->connect_error){
    die("Connection Failed.".$conn->connect_error);
}
echo "connection successfully";
?>