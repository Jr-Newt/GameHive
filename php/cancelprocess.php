<html>
<head></head>
</html>
<body>
<?php
if(isset($_POST['back'])){
//error_reporting( error_reporting() & ~E_NOTICE );
include_once 'config.php';
include "controllerUserData.php";
 $_SESSION['cart'] = '';
$date= $_SESSION['transact'];
$t_id = $date;
$sql = "DELETE FROM orders WHERE transact_id = :id";
if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":id", $param_id);

    // Set parameters
    $param_id = $t_id;

    // Attempt to execute the prepared statement
    $stmt->execute();
    echo "successful";
}
$sql = "DELETE FROM payments WHERE transact_id = :id";
if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":id", $param_id);

    // Set parameters
    $param_id = $t_id;

    // Attempt to execute the prepared statement
    $stmt->execute();
    echo "successful";
}
else{
    echo "failed";
}

header("location: homepagenew.php");
exit();
}


?>

</body>