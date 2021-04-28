<?php
//including the database connection file
include("config.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$sql = "DELETE FROM gear_store WHERE gear_id=:gear_id";
$query = $dbConn->prepare($sql);
$query->execute(array(':gear_id' => $id));
 
//redirecting to the display page (index.php in our case)
header("Location:admin_gear.php");
?>