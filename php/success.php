<?php
// Include configuration file
error_reporting( error_reporting() & ~E_NOTICE );
include_once 'config.php';
include "controllerUserData.php";

 $date= $_SESSION['transact'];
 //echo $date;
 $t_id = $date;
 //$t_id = strtotime($t);
 //echo $t_id;
 //$t_id = date_format($date,"Y-m-d H:i:s");
 //$t_id = $t_id.'000000';
//echo $_SESSION['email'];

// Include database connection file
//include_once 'dbConnect.php'; ?>
<?php
/* If transaction data is available in the URL
if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){
    // Get transaction information from URL
    $item_number = $_GET['item_number'];
    $txn_id = $_GET['tx'];
    $payment_gross = $_GET['amt'];
    $currency_code = $_GET['cc'];
    $payment_status = $_GET['st'];

    // Get product info from the database
    $productResult = $db->query("SELECT * FROM products WHERE id = ".$item_number);
    $productRow = $productResult->fetch_assoc();

    // Check if transaction data exists with the same TXN ID.
    $prevPaymentResult = $db->query("SELECT * FROM payments WHERE txn_id = '".$txn_id."'");

    if($prevPaymentResult->num_rows > 0){
        $paymentRow = $prevPaymentResult->fetch_assoc();
        $payment_id = $paymentRow['payment_id'];
        $payment_gross = $paymentRow['payment_gross'];
        $payment_status = $paymentRow['payment_status'];
    }else{
        // Insert tansaction data into the database
        $insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
        $payment_id = $db->insert_id;
    }
}
?>*/?>


       <?php if(empty($payment_id))
       {
         include "config.php";
          //$transact = date('y-m-d h:i:s');
          $sql = "UPDATE orders SET  status=:status WHERE transact_id=:t";
          if($stmt = $pdo->prepare($sql)){
          $stmt->bindParam(":t", $t);
          $stmt->bindParam(":status", $s);
          //$stmt->bindParam(":user_id", $user_id);
          //$user_id = $_SESSION['user_id'];
          $t= $t_id;
          $s=1;
          $stmt->execute();
          }
          //$s = 1;
          //include "connection.php";
          //$update = "UPDATE orders SET status = $s WHERE transact_id='$t_id'";
            //$update_res = mysqli_query($con, $update);
          $sql = "UPDATE payments SET status=:status WHERE transact_id=:t";
          if($stmt = $pdo->prepare($sql)){
          $stmt->bindParam(":status", $s);
          $stmt->bindParam(":t", $t);
          //$stmt->bindParam(":user_id", $user_id);
          //$user_id = $_SESSION['user_id'];
          $t = $t_id;
          $s=1;
          $stmt->execute();
          }
          $sql = "SELECT * FROM payments WHERE transact_id=:t";
          if($stmt = $pdo->prepare($sql)){
          //$stmt->bindParam(":status", $s);
          $stmt->bindParam(":t", $t);
          //$stmt->bindParam(":user_id", $user_id);
          //$user_id = $_SESSION['user_id'];
          $t = $t_id;
          $s=1;
          if($stmt->execute())
          {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $price = $row['price'];
          $t= $row['transact_id'];
          if($row['status']==1){
            $status = "successful";
          }
          else{
            $status = "failed. Contact admin.";
          }
          }

          }
          if(!empty($_SESSION['game']))
          {
            $subject = "confirmation";
          $message = "$_SESSION[game] download link will be sent shortly. Enjoy!! \n Your Transaction ID: $t \n Total amt: $price \n Payment Status: $status";
          $sender = "From: gamehiveglobal";
          $email = $_SESSION['email'];
          }
          else{
            $subject = "confirmation";
          $message = "Order is confirmed \n Your Transaction ID: $t \n Total amt: $price \n Payment Status: $status";
          $sender = "From: gamehiveglobal";
          $email = $_SESSION['email'];
          }
          if(mail($email, $subject, $message, $sender)){
              $info = "We've sent a confirmation details to your email";
            }?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <title>Success</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
              <style>
              .ack{
                margin-top:20px;
                display:grid;
                grid-template-columns: 1fr;
                grid-template-rows: 1fr;
                justify-content: center;
                margin-bottom:30px;
              }
              .card{
                justify-self: center;
              }
              </style>

            </head>
            <body>
              
            <h1 style="text-align:center;">Payment Succesful</h1>
            <!--h1></h1-->
            <div class="ack">
              <div class="card" style="width: 18rem;">
                <img src="..\images\check.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="card-text"><?php echo $info;?></p>
                </div>
              </div>
            </div>
            
          <?php
           //echo $_SESSION['cart'];
             $_SESSION['cart'] = '';
             $_SESSION['game'] = '';

             //echo $_SESSION['cart'];

            ?>
            <a href="homepagenew.php" class="btn btn-primary" style="width:25%;">Home</a>
		<?php
    }?>
     </body>
            </html>
