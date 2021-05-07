<?php
//error_reporting( error_reporting() & ~E_NOTICE );
include "controllerUserData.php";
include "config.php";
include "connection.php";
include "cart_config.php";


$id = $_SESSION['user_id'];
/*$query = $pdo->prepare('SELECT * FROM gearstore WHERE id = ?');
    $query->execute([$id]);
    if($query->rowCount() > 0){
        $notempty = 1;
    }
    else{
        $notempty = 0;
    }*/
if(isset($_POST['cart']))
    {
        echo $_POST['price'];
      /*include "config.php";
            $sql = "INSERT INTO orders (user_id,gear_id,price,qty,status) VALUES (:user_id,:gear_id,:price,:qty,:status)";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":gear_id", $gear_id);
              //$stmt->bindParam(":transact_id", $transact);
              $stmt->bindParam(":price", $sub);
              $stmt->bindParam(":qty", $qty);
              $stmt->bindParam(":status", $s);
                $s = 0;
              // Set parameters
              $user_id = $_SESSION['user_id'];
              $gear_id = $_POST['product_id'];
              $qty = $_POST['quantity'];
              //$transact = date('y-m-d h:i:s');
              $sub= $_POST['price'];
              $stmt->execute();
    }*/
    }

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $sql = "INSERT INTO orders (user_id,gear_id,price,qty,status) VALUES (:user_id,:gear_id,:price,:qty,:status)";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":gear_id", $gear_id);
              //$stmt->bindParam(":transact_id", $transact);
              $stmt->bindParam(":price", $sub);
              $stmt->bindParam(":qty", $qty);
              $stmt->bindParam(":status", $s);
                $s = 0;
              // Set parameters
              $user_id = $_SESSION['user_id'];
              $gear_id = $_POST['product_id'];
              $qty = $_POST['quantity'];
              //$transact = date('y-m-d h:i:s');
              $sub= $_POST['price'];
              $stmt->execute();
    }


    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM gearstore WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: cartfinal.php');
    exit;
}
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: cartfinal.php');
    exit;
}
//if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    //header('Location: cartfinal.php');
    //exit;
//}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$total_qty = 0;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM gearstore WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
        $total_qty+=(int)$products_in_cart[$product['id']];
    }
    //echo $total_qty;
}
?>
<html>
<head>
<title>shopping cart</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="cart_style2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="homepagenew.php"><img src="../images/bee-logo-linear-vector-icon_126523-265.jpg" alt="Logo" style="width:40px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="gear_display.php">Gear Comb</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="game_display.php">Game Comb</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo $_SESSION['name']; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="bi bi-cart2" style="font-size: 1.28em;"></i></a>
            </li>

            </ul>
            <!--div class="flex-row-reverse"--><ul class="navbar-nav">
            <li class="nav-item flex-row-reverse">
              <a class="nav-link" href="logout-user.php">Logout<span class="sr-only">(current)</span></a>
            </li>
            </ul>


            <!--form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form-->


            </div>
            </nav>
<div class="cart ">
    <h3>Shopping Cart</h3>
    <form action="cartfinal.php" method="post">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="gear_page.php?id=<?php echo $product['id'];?>">
                            <img src="..\images\<?php echo $product['gearimage']?>" width="50" height="50" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="gear_page.php?id=<?php echo $product['id'];?>"><?=$product['name']?></a>
                        <br>
                        <a href="cartfinal.php?remove=<?=$product['id']?>" class="remove">Remove</a>
                    </td>
                    <td class="price">$<?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" class="form-control" required>
                    </td>
                    <td class="price">$<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="section2">
        <div class="subtotal">
            <label for="" class="from-control">subtotal:</label>
            <!--?php echo $_POST['price'];?-->
            <span class="price">$<?php echo $subtotal.''.PAYPAL_CURRENCY;?></span>
        </div>
        <div class="buttons">
            <div class="btn1"><input type="submit" value="Update" name="update" class="btn btn-success"></div>
            <div class="btn2"><input type="submit" value="Place Order" name="placeorder" class="btn btn-primary"></div>



        </div>

            </div>

        </div>
    </form>
    <?php
    if(isset($_POST['placeorder']))
    {
?>
            <!-- PayPal payment form for displaying the buy button -->
            <form action="<?php echo PAYPAL_URL; ?>" method="post">
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">

                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="<?php echo"product1"; ?>">
                    <input type="hidden" name="item_number" value="<?php echo"id"; ?>">
                    <input type="hidden" name="amount" value="<?php echo $subtotal; ?>">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                    <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
                    <!--input type="hidden" name="notify_url" value="https://www.codexworld.com/paypal_ipn.php"-->

                    <!-- Display the payment button. -->
                    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                </form>
            <?php
           //unset($_SESSION['cart']);
           include "config.php";
            $sql = "INSERT INTO payments (user_id,price,transact_id,status) VALUES (:user_id,:price,:transact_id,:status)";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":transact_id", $transact);
              $stmt->bindParam(":price", $sub);
              $stmt->bindParam(":status", $s);

              // Set parameters
              $user_id = $_SESSION['user_id'];
              $s = 0;
              date_default_timezone_set('Asia/Kolkata');
                $trans = date('y-m-d h:i:s');
                $_SESSION['transact']  = str_replace( array(':','-',' '),'', $trans);

                $transact = $_SESSION['transact'];
              //$transact = date('y-m-d h:i:s');
              $sub= $subtotal;
              $stmt->execute();

            }

            $sql = "UPDATE orders SET transact_id = :transact_id WHERE user_id=:user_id AND status = :status";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":transact_id", $transact);
              //$stmt->bindParam(":price", $sub);
              $stmt->bindParam(":status", $s);

              // Set parameters
              $user_id = $_SESSION['user_id'];
              $s = 0;
              //date_default_timezone_set('Asia/Kolkata');
                $transact = $_SESSION['transact'];
              //$transact = date('y-m-d h:i:s');
              //$sub= $subtotal;
              $stmt->execute();

            }
              ?>
   <?php
    }
    ?>
</div>
</body>
</html>
