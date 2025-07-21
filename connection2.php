<h1>
<pre>
    The connect() /mysql_connect() function opens a new connection to the Mysql server.
</pre>

</h1>


<?php
$conn= mysqli_connect("localhost","root","","new_database");
if(!$conn){
    die("connection Failed.");
}
echo "connection sucessfully";
?>
