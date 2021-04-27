<?php
error_reporting( error_reporting() & ~E_NOTICE );
include "controllerUserData.php";
include "config.php";
include "connection.php";

$id = $_SESSION['user_id'];
$sql = "SELECT *, cart.id AS cartid FROM cart LEFT JOIN cart ON gearstore.id=cart.product_id WHERE user_id=:user_id";
if($stmt = $pdo->prepare($sql))
        {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":user_id", $param_user_id);

            // Set parameters
            $param_user_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute())
            {
                if($stmt->rowCount()>=1)
                {
				?>
                    <table class=table table-bordered table-striped>'
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                                while($row = $stmt->fetch()){
									?>
                                    <tr>
                                        <td><img src="../images/<?php echo $row['gearimage'];?>" alt="" style="width:50px;"></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td><?php echo $row['qty'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td> . $row['gameimage'] . </td>
                                        <td>
                                            '<a href=gameread.php?id='. $row['id'] .' class=mr-0 title=View Record data-toggle=tooltip><span class=fa fa-eye></span></a>'
                                            '<a href=gameupdate.php?id='. $row['id'] .' class=mr-0 title=Update Record data-toggle=tooltip><span class=fa fa-pencil></span></a>'
                                            '<a href=gamedelete.php?id='. $row['id'] .' title=Delete Record data-toggle=tooltip><span class=fa fa-trash></span></a>'
                                        </td>
                                    </tr>
                                }
                                </tbody>
                            </table>
                }}}
?>
<html>
<head><title>shopping cart</title>

</head>
<body>

</body>
</html>
