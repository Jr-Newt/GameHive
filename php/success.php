<?php
// Include configuration file
error_reporting( error_reporting() & ~E_NOTICE );
include_once 'config.php';
include "controllerUserData.php";
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

<div class="container">
    <div class="status">
       <?php if(empty($payment_id)){
          $subject = "confirmation";
          $message = "Order is confirmed";
          $sender = "From: gamehiveglobal";
          $email = $_SESSION['email'];
          if(mail($email, $subject, $message, $sender)){
              $info = "We've sent a confirmation details to your email";
            }?>
            <h1 class="success"><?php echo $info;?></h1>

            <h1>Payment Succesful</h1>
          <?php
           echo $_SESSION['cart'];
             $_SESSION['cart'] = '';
             echo $_SESSION['cart'];

            ?>
            <a href="homepagenew.php" class="btn btn-primary" style="width:25%;">Home</a>
		<?php
    }?>
